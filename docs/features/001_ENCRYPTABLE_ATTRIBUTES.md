# Encryptable Attributes

As part of building a medical CRM — with future plans to evolve into an EHR (Electronic Health Record) system or similar — protecting user-sensitive data is a top priority. For that reason, any attribute that could potentially identify a user is encrypted by default.

## Attribute Encryption in Laravel

Laravel offers native support for encrypted casting using the `encrypted` type in the `$casts` array:

```php
/**
 * Get the attributes that should be cast.
 *
 * @return array<string, string>
 */
protected function casts(): array
{
    return [
        'email' => 'encrypted',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
```

## Key Rotation Support

Laravel uses the `APP_KEY` to encrypt and decrypt data. Over time, this key should be rotated to maintain cryptographic hygiene. Laravel provides built-in support for key rotation:

➡️ https://laravel.com/docs/12.x/encryption#gracefully-rotating-encryption-keys

However, encrypted attribute values must be manually re-encrypted after a key change. To automate this process, a custom Artisan command was created.

## Artisan Command: Rotate Encrypted Attributes

```bash
php artisan crypt:rotate-encrypted-attributes
```

Command class: [/app/Console/Commands/Encryption/RotateEncryptedAttributes.php](/app/Console/Commands/Encryption/RotateEncryptedAttributes.php)

This command scans for models implementing the following interface:

[/app/Contracts/Encryption/ShouldRotateEncryptedFields.php](/app/Contracts/Encryption/ShouldRotateEncryptedFields.php)

Each model is then processed via the method:

```php
$model->rotateEncryptedFields()
```

## How to Test Locally

To test the encryption rotation process locally:

1. Reset your database and seed test data:
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class="Database\\Seeders\\Features\\RotateEncryptedAttributesSeeder"
   ```

2. Move the current key to `APP_PREVIOUS_KEYS` in `.env`:
   ```env
   APP_PREVIOUS_KEYS=base64:your-old-key-here
   ```

3. Generate a new encryption key:
   ```bash
   php artisan key:generate
   ```

4. Run the command to re-encrypt all applicable fields:
   ```bash
   php artisan crypt:rotate-encrypted-attributes
   ```

## Internal Logic and Testing

You can track the internal behavior of the rotation logic with descriptive unit tests:

[/tests/Unit/Actions/Encryption/RotateModelEncryptedFieldsTest.php](/tests/Unit/Actions/Encryption/RotateModelEncryptedFieldsTest.php)

## Column Size Handling

Encrypted values are significantly larger than their original plaintext equivalents. This is due to Laravel’s encryption process, which includes serialization, an initialization vector (IV), a message authentication code (MAC), and base64 encoding.

On average, an encrypted string grows approximately 4x its original size. To prevent truncation or overflow errors, we define conservative column sizes using a 5x safety margin.

These standardized sizes are configured in:

[/config/database.php](/config/database.php) → `encryptables` section

> ⚠️ **Note:** These values may evolve over time. Always refer to the config file to confirm the current size recommendations.

### Column Size Reference

| Enum Constant                      | Max Plaintext Length | Recommended Column Size |
|-----------------------------------|-----------------------|--------------------------|
| `EncryptedColumnSize::SMALL`      | 64                    | 768                      |
| `EncryptedColumnSize::MEDIUM`     | 128                   | 1280                     |
| `EncryptedColumnSize::LARGE`      | 256                   | 2560                     |

> These values are used to safely allocate space for encrypted attributes in your database schema.

### Enum Reference

Column sizes are declared via the enum:

[/app/Enums/Encryption/EncryptedColumnSize.php](/app/Enums/Encryption/EncryptedColumnSize.php)

### Usage in Migrations

Laravel’s Blueprint has been extended to support encryption-safe strings using the `encryptableString()` method:

```php
use App\Enums\Encryption\EncryptedColumnSize;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

Schema::create('patients', function (Blueprint $table) {
    $table->id();
    $table->encryptableString('email', EncryptedColumnSize::SMALL);
    $table->encryptableString('full_name', EncryptedColumnSize::MEDIUM);
    $table->encryptableString('address', EncryptedColumnSize::LARGE);
    $table->timestamps();
});
```

This ensures all encrypted columns are sized appropriately and consistently across all migrations.
