<?php

namespace App\Http\Traits;

use Storage;

trait MediaTrait
{
    protected $useOriginalExtension = ['svg'];
    /**
     * 上傳檔案 並返回
     * [
     *     'file_name => originalName,
     *     'file_url  => file store path
     * ]
     *
     * @param [type] $file
     * @param [string] $path
     * @return array
     */
    protected function storeFile($file, $path)
    {
        $extension = $file->guessExtension();
        $originalExtension = $file->getClientOriginalExtension();

        if (!$extension || in_array($originalExtension, $this->useOriginalExtension)) {
            $extension = $originalExtension;
        }

        $fileName = str_random(20) . "." . $extension;

        $url = $file->storeAs($path, $fileName);

        return [
            'file_name' => $file->getClientOriginalName(),
            'file_url' => str_replace_first('public', '/storage', $url),
        ];
    }

    protected function storeFiles($files, $path)
    {
        $fileInfoList = [];

        foreach ($files as $file) {
            array_push($fileInfoList, $this->storeFile($file, $path));
        }

        return $fileInfoList;
    }

    public static function deleteFile($url)
    {
        $filePath = str_replace_first('/storage', '/public', $url);
        $dirPath = dirname($filePath);

        Storage::delete($filePath);

        if (empty(Storage::allFiles($dirPath))) {
            Storage::deleteDirectory($dirPath);
        }
    }
}
