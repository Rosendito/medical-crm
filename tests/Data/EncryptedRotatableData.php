<?php

namespace Tests\Data;

use App\Concerns\Actions\ResolvableAction;

class EncryptedRotatableData
{
    use ResolvableAction;

    public function getStubsModelsNamespace(): string
    {
        return 'Tests\\Stubs\\EncryptedRotatableModels\\';
    }

    public function getStubsModelsPath(): string
    {
        return base_path('tests/Stubs/EncryptedRotatableModels');
    }

    public function getRotatableModelNames(): array
    {
        return [
            $this->getStubModelName('UserData'),
            $this->getStubModelName('Some\\Deep\\ModelWithSensibleData'),
        ];
    }

    public function getStubModelName(string $modelName): string
    {
        return $this->getStubsModelsNamespace().$modelName;
    }
}
