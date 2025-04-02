<?php

namespace App\Actions\Encryption;

use App\Concerns\Actions\ResolvableAction;
use Illuminate\Support\Collection;
use SplFileInfo;
use Symfony\Component\Finder\Finder;

class FindModelsWithEncryptedFieldsToRotate
{
    use ResolvableAction;

    protected string $modelsPath;

    public function __construct(
        protected Finder $finder,
        $modelsPath = null
    ) {
        $this->modelsPath = $modelsPath ?? app_path('Models');
    }

    public function handle()
    {
        $modelClasses = $this->getModelClasses($this->getModelFinder());

        dd($modelClasses);
    }

    protected function getModelFinder(): Finder
    {
        return $this->finder->files()->in($this->modelsPath)->name('*.php');
    }

    protected function getModelNamespace(string $relativePathname): string
    {
        return 'App\\Models\\'.str_replace(['/', '.php'], ['\\', ''], $relativePathname);
    }

    protected function getModelClasses(Finder $finder): Collection
    {
        return collect($finder)
            ->map(function (SplFileInfo $file) {
                $modelClass = $this->getModelNamespace($file->getRelativePathname());

                if (! class_exists($modelClass)) {
                    return null;
                }

                return $modelClass;
            })
            ->filter()
            ->values();
    }
}
