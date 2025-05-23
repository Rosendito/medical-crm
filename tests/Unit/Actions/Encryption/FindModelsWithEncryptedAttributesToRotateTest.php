<?php

namespace Tests\Unit\Actions\Encryption;

use App\Actions\Encryption\FindModelsWithEncryptedAttributesToRotate as TestTargetAction;
use Symfony\Component\Finder\Finder;
use Tests\Data\EncryptedRotatableData;
use Tests\TestCase;

class FindModelsWithEncryptedAttributesToRotateTest extends TestCase
{
    protected EncryptedRotatableData $testData;

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = EncryptedRotatableData::make();

        $this->app->bind(TestTargetAction::class, function () {
            return new TestTargetAction(
                new Finder,
                $this->testData->getStubsModelsNamespace(),
                $this->testData->getStubsModelsPath()
            );
        });
    }

    public function test_it_finds_encrypted_rotatable_model_class_names(): void
    {
        $models = TestTargetAction::make()->handle();
        $expectedModels = $this->testData->getRotatableModelNames();

        $this->assertEqualsCanonicalizing($expectedModels, $models);
    }
}
