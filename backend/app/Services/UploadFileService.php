<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFileService
{
    /**
     * ファイルをstorageに保存
     *
     * @param UploadedFile $file
     * @param string $dir
     * @return string
     */
    public function createFileToStorage(UploadedFile $file, string $dir): string
    {
        $newFileName = $file->getClientOriginalName();
        $file->storeAs($dir, $newFileName);

        return $newFileName;
    }

    /**
     * ファイルをstorageから取得
     *
     * @param string $filePath
     * @param string $disk
     * @return string|null
     */
    public function getFileForStorage(string $filePath, string $disk): string|null
    {
        return Storage::disk($disk)->get($filePath);
    }

    /**
     * ファイルをstorageから削除
     *
     * @param string $fileName
     * @return bool
     */
    public function deleteFileForStorage(string $fileName): bool
    {
        return Storage::delete($fileName);
    }
}
