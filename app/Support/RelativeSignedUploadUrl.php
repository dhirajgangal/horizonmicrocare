<?php

namespace App\Support;

use Illuminate\Support\Facades\URL;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Livewire\Features\SupportFileUploads\GenerateSignedUploadUrl;

class RelativeSignedUploadUrl extends GenerateSignedUploadUrl
{
    public function forLocal()
    {
        return URL::temporarySignedRoute(
            'livewire.upload-file',
            now()->addMinutes(FileUploadConfiguration::maxUploadTime()),
            absolute: false,
        );
    }
}
