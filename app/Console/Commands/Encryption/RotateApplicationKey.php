<?php

namespace App\Console\Commands\Encryption;

use App\Actions\Encryption\FindModelsWithEncryptedFieldsToRotate;
use Illuminate\Console\Command;

class RotateApplicationKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rotate-application-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rotate the application key and update the encrypted fields';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FindModelsWithEncryptedFieldsToRotate::make()->handle();
    }
}
