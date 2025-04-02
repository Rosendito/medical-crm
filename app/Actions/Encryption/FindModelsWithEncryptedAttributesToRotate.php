<?php

namespace App\Actions\Encryption;

use App\Concerns\Actions\ResolvableAction;
use App\Contracts\Encryption\ShouldRotateEncryptedAttributes;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class FindModelsWithEncryptedAttributesToRotate
{
    use ResolvableAction;

    protected string $modelsPath;

    public function __construct(
        protected Finder $finder,
        protected string $namespace = 'App\\Models\\',
        ?string $modelsPath = null
    ) {
        $this->modelsPath = $modelsPath ?? app_path('Models');
    }

    /**
     * Find all model classes within the target path
     * that implement the ShouldRotateEncryptedAttributes interface.
     *
     * @return array<int, class-string>
     */
    public function handle(): array
    {
        $modelFiles = $this->getModelFiles();

        $modelsToRotate = [];

        foreach ($modelFiles as $file) {
            $className = $this->resolveClassName($file);

            if (! $this->isValidRotatableModel($className)) {
                continue;
            }

            $modelsToRotate[] = $className;
        }

        return $modelsToRotate;
    }

    /**
     * @return iterable<SplFileInfo>
     */
    protected function getModelFiles(): iterable
    {
        return $this->finder
            ->files()
            ->in($this->modelsPath)
            ->name('*.php');
    }

    protected function resolveClassName(SplFileInfo $file): string
    {
        $relativePath = $file->getRelativePathname();

        return $this->namespace.str_replace(['/', '.php'], ['\\', ''], $relativePath);
    }

    protected function isValidRotatableModel(string $className): bool
    {
        if (! class_exists($className)) {
            return false;
        }

        return in_array(ShouldRotateEncryptedAttributes::class, class_implements($className));
    }
}
