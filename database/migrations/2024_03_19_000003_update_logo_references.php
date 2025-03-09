<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    public function up()
    {
        // Update logo references in the view files
        $files = [
            'resources/views/layouts/navigation.blade.php',
            'resources/views/layouts/app.blade.php',
            'resources/views/auth/login.blade.php',
        ];

        foreach ($files as $file) {
            $content = File::get($file);
            $content = str_replace('logo.png', 'logo_kasir.png', $content);
            File::put($file, $content);
        }
    }

    public function down()
    {
        // This migration cannot be reversed as we don't store the original logo references
    }
};
