<?php

namespace Tests\Unit\Database;

use App\Enums\Encryption\EncryptedColumnSize;
use App\Models\User;
use App\Models\Users\UserAddress;
use Illuminate\Support\Str;
use Tests\TestCase;

class EncryptedColumnLengthTest extends TestCase
{
    protected const TOTAL_ITERATIONS = 25;

    public function test_encrypted_values_respect_configured_column_limits(): void
    {
        foreach (range(1, self::TOTAL_ITERATIONS) as $iteration) {
            foreach (['fake', 'emoji', 'realistic'] as $inputType) {
                $this->assertAllEncryptedFieldsAreWithinLimits($inputType);
            }
        }
    }

    protected function assertAllEncryptedFieldsAreWithinLimits(string $inputType): void
    {
        foreach (EncryptedColumnSize::cases() as $columnSize) {
            $plainText = $this->generatePlainTextForColumnSize($columnSize, $inputType);

            $this->assertEncryptedValueIsWithinLimit($columnSize, $plainText, $inputType);
        }
    }

    protected function assertEncryptedValueIsWithinLimit(
        EncryptedColumnSize $columnSize,
        string $plainText,
        string $label
    ): void {
        [$model, $attribute] = $this->createModelWithEncryptedField($columnSize, $plainText);

        $rawEncryptedValue = $model->getRawOriginal($attribute);
        $maxAllowedLength = $columnSize->encryptedStringLimit();
        $modelFieldPath = get_class($model).'.'.$attribute;

        $this->assertLessThanOrEqual(
            $maxAllowedLength,
            strlen($rawEncryptedValue),
            "Encrypted value for {$modelFieldPath} ({$label}) exceeded max length of {$maxAllowedLength}."
        );
    }

    protected function createModelWithEncryptedField(EncryptedColumnSize $columnSize, string $value): array
    {
        return match ($columnSize) {
            EncryptedColumnSize::SMALL => [
                User::factory()->create(['email' => $value]),
                'email',
            ],
            EncryptedColumnSize::MEDIUM => [
                UserAddress::factory()->create(['label' => $value]),
                'label',
            ],
            EncryptedColumnSize::LARGE => [
                UserAddress::factory()->create(['street_line_1' => $value]),
                'street_line_1',
            ],
        };
    }

    protected function generatePlainTextForColumnSize(
        EncryptedColumnSize $columnSize,
        string $inputType
    ): string {
        $limit = $columnSize->plainStringLimit();

        return match ($inputType) {
            'fake' => Str::random($limit),
            'emoji' => collect()->times($limit, fn () => fake()->emoji())->join(''),
            'realistic' => $this->generateRealisticText($columnSize, $limit)
        };
    }

    protected function generateRealisticText(EncryptedColumnSize $columnSize, int $limit): string
    {
        return match ($columnSize) {
            EncryptedColumnSize::SMALL => Str::limit(fake()->email(), $limit, ''),
            EncryptedColumnSize::MEDIUM => Str::limit(fake()->sentence(20).' '.fake()->emoji(), $limit, ''),
            EncryptedColumnSize::LARGE => Str::limit(fake()->address().' '.fake()->emoji(), $limit, ''),
        };
    }
}
