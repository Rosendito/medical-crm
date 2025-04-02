<?php

namespace App\Actions\Encryption;

use App\Concerns\Actions\ResolvableAction;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class RotateModelEncryptedAttributes
{
    use ResolvableAction;

    /**
     * Re-encrypts all encrypted attributes of a given model implementing
     * ShouldRotateEncryptedAttributes. This is useful when rotating encryption keys.
     *
     * @param  ShouldRotateEncryptedAttributes&Model  $model
     */
    public function handle(ShouldRotateEncryptedAttributes $model): void
    {
        $encryptedAttributes = $model->getEncryptedAttributes();

        foreach ($encryptedAttributes as $attribute) {
            $oldValue = Crypt::decryptString($model->getRawOriginal($attribute));

            $model->setAttribute($attribute, $oldValue);
        }

        $model->save();
    }
}
