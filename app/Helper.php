<?php

use Illuminate\Support\Facades\Storage;

function uploadFile($file, $path)
{
    Storage::disk('public')->put($path, file_get_contents($file));
}

function getFile($path, $dummy = 'img/logo.png')
{
    return Storage::disk('public')->exists($path) ? Storage::disk('public')->url($path) : asset($dummy);
}

function deleteFile($path)
{
    Storage::disk('public')->delete($path);
}

if (! function_exists('convertAsTitle')) {
    function convertAsTitle($string)
    {
        // Convert to Title Case
        $title = ucwords($string);

        // Very basic pluralization (naive approach)
        if (str_ends_with($title, 'y')) {
            // e.g., "Category" -> "Categories"
            $plural = substr($title, 0, -1) . 'ies';
        } elseif (str_ends_with($title, 's')) {
            // e.g., "Class" -> "Classes"
            $plural = $title . 'es';
        } else {
            // e.g., "Book" -> "Books"
            $plural = $title . 's';
        }

        return $plural;
    }
}
