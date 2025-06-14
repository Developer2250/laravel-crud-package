<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopySchemaFiles extends Command
{
    // command: php artisan schemas:copy
    protected $signature = 'schemas:copy';
    protected $description = 'Copy all JSON schema files from storage/app/schemas to public/schemas';

    public function handle()
    {
        $source = storage_path('app/schemas');
        $destination = public_path('schemas');

        if (!File::exists($source)) {
            $this->error("Source folder does not exist: $source");
            return Command::FAILURE;
        }

        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
            $this->info("Created destination directory: $destination");
        }

        foreach (File::files($source) as $file) {
            if ($file->getExtension() === 'json') {
                File::copy($file->getRealPath(), $destination . '/' . $file->getFilename());
                $this->info("Copied: {$file->getFilename()}");
            }
        }

        $this->info('All JSON schema files copied successfully.');
        return Command::SUCCESS;
    }
}
