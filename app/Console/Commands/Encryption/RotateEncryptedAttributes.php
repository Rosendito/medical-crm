<?php

namespace App\Console\Commands\Encryption;

use App\Actions\Encryption\FindModelsWithEncryptedFieldsToRotate;
use Illuminate\Console\Command;
use Laravel\Prompts\Progress;
use Laravel\Prompts\Table;

class RotateEncryptedAttributes extends Command
{
    protected const CHUNK_SIZE = 100;

    protected const SUMMARY_HEADER = ['Model Name', 'Updated'];

    protected $signature = 'crypt:rotate-encrypted-attributes';

    protected $description = 'Rotate encrypted attributes for models that require it.';

    public function handle(): void
    {
        $modelClasses = collect(FindModelsWithEncryptedFieldsToRotate::make()->handle());

        if ($modelClasses->isEmpty()) {
            $this->info('No models found with encrypted fields to rotate.');

            return;
        }

        $this->info("Found {$modelClasses->count()} model types to process.");
        $this->newLine();

        $summaryRows = $modelClasses
            ->map(fn (string $modelClass) => [$modelClass, (string) $this->processModelRotation($modelClass)])
            ->all();

        $this->newLine();
        $this->showSummaryTable($summaryRows);
    }

    protected function processModelRotation(string $modelClass): int
    {
        $model = new $modelClass;
        $query = $model->newQuery();
        $totalRecords = $query->count();

        if ($totalRecords === 0) {
            $this->warn("No records found for {$modelClass}.");

            return 0;
        }

        $this->info("Processing {$totalRecords} records for {$modelClass}...");

        return $this->rotateModelRecords($query, $model->getKeyName(), $modelClass, $totalRecords);
    }

    protected function rotateModelRecords($query, string $keyName, string $modelClass, int $totalRecords): int
    {
        $updatedCount = 0;
        $progress = new Progress("Rotating {$modelClass} records", $totalRecords);

        $query
            ->orderBy($keyName)
            ->chunk(
                static::CHUNK_SIZE,
                function ($chunk) use ($progress, &$updatedCount) {
                    $this->rotateChunk($chunk, $progress, $updatedCount);
                }
            );

        $progress->finish();
        $this->newLine(2);

        return $updatedCount;
    }

    protected function rotateChunk($chunk, Progress $progress, int &$updatedCount): void
    {
        foreach ($chunk as $model) {
            $model->rotateEncryptedFields();

            $updatedCount++;

            $progress->advance();
        }
    }

    protected function showSummaryTable(array $rows): void
    {
        (new Table(static::SUMMARY_HEADER, $rows))->display();
    }
}
