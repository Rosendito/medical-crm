<?php

namespace App\Actions\Encryption;

use App\Concerns\Actions\ResolvableAction;
use App\Contracts\Encryption\ShouldRotateEncryptedFields;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class RotateModelEncryptedFields
{
    use ResolvableAction;

    /**
     * Re-encrypts all encrypted attributes of a given model implementing
     * ShouldRotateEncryptedFields. This is useful when rotating encryption keys.
     *
     * @param  ShouldRotateEncryptedFields&Model  $model
     */
    public function handle(ShouldRotateEncryptedFields $model): void
    {
        $encryptedAttributes = $model->getEncryptedAttributes();

        foreach ($encryptedAttributes as $attribute) {
            $oldValue = Crypt::decryptString($model->getRawOriginal($attribute));

            $model->setAttribute($attribute, $oldValue);
        }

        $model->save();
    }
}
