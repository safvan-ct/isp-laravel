<?php

use Illuminate\Support\Facades\Storage;

function uploadFile($file, $path)
{
    Storage::disk('public')->put($path, file_get_contents($file));
}

function getFile($path, $dummy = 'img/logo.svg')
{
    return Storage::disk('public')->exists($path) ? Storage::disk('public')->url($path) : asset($dummy);
}

function deleteFile($path)
{
    Storage::disk('public')->delete($path);
}
