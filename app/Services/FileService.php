<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService {
    public function upload($file, $path, $uniqueIdentifyer) {
        $fileName = $file->getClientOriginalName();
        $uniqueFileName = $uniqueIdentifyer . '___' . $fileName;
        // $fileExtension = $file->getClientOriginalExtension();
        // $uniqueFileName = $uniqueIdentifyer . ".{$fileExtension}";

        if(Storage::disk('public')->exists($uniqueFileName)) return;
        $storedFile = $file->storeAs("media/{$path}", $uniqueFileName, 'public');

        return $storedFile;
    }
    
    public function delete($filePath) {
        Storage::disk('public')->delete($filePath);
    }

}