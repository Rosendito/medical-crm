<?php

namespace Tests\Unit\Actions\Encryption;

use App\Actions\Encryption\RotateModelEncryptedFields;
use App\Contracts\Encryption\ShouldRotateEncryptedFields;
use App\Models\User;
use App\Models\Users\UserAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class RotateModelEncryptedFieldsTest extends TestCase
{
    protected const SAMPLE_STREET_LINE = 'Some place in the planet';

    protected const SAMPLE_LABEL = 'Home address';

    protected const SAMPLE_EMAIL = 'someone@example.com';

    public function test_it_rotates_encrypted_field_user_address_street_line(): void
    {
        $this->runEncryptionRotationAssertion(UserAddress::class, [
            'field' => 'street_line_1',
            'value' => self::SAMPLE_STREET_LINE,
        ]);
    }

    public function test_it_rotates_encrypted_field_user_address_label(): void
    {
        $this->runEncryptionRotationAssertion(UserAddress::class, [
            'field' => 'label',
            'value' => self::SAMPLE_LABEL,
        ]);
    }

    public function test_it_rotates_encrypted_field_user_email(): void
    {
        $this->runEncryptionRotationAssertion(User::class, [
            'field' => 'email',
            'value' => self::SAMPLE_EMAIL,
        ]);
    }

    protected function runEncryptionRotationAssertion(string $modelClass, array $fieldData): void
    {
        [$oldKey, $newKey] = $this->generateKeys();

        $this->setEncryptionKey($oldKey);

        /** @var Model&ShouldRotateEncryptedFields $model */
        $model = $modelClass::factory()->create([
            $fieldData['field'] => $fieldData['value'],
        ]);

        $originalEncryptedValue = $model->getRawOriginal($fieldData['field']);

        $this->setEncryptionKey($newKey, [$oldKey]);

        RotateModelEncryptedFields::make()->handle($model->fresh());

        $model->refresh();

        $this->assertEncryptedFieldWasRotated($model, $fieldData['field'], $originalEncryptedValue);
        $this->assertDecryptedValueIsSame($model, $fieldData['field'], $fieldData['value']);
    }

    protected function generateKeys(): array
    {
        $cipher = Config::get('app.cipher');

        return [
            Crypt::generateKey($cipher),
            Crypt::generateKey($cipher),
        ];
    }

    protected function setEncryptionKey(string $key, array $previousKeys = []): void
    {
        Config::set('app.key', $key);
        Config::set('app.previous_keys', $previousKeys);
    }

    protected function assertEncryptedFieldWasRotated($model, string $field, string $originalEncryptedValue): void
    {
        $this->assertNotSame(
            $originalEncryptedValue,
            $model->getRawOriginal($field),
            "Expected the encrypted value of '{$field}' to change after key rotation."
        );
    }

    protected function assertDecryptedValueIsSame($model, string $field, string $expected): void
    {
        $this->assertSame(
            $expected,
            $model->getAttribute($field),
            "Expected the decrypted value of '{$field}' to remain the same after key rotation."
        );
    }
}
