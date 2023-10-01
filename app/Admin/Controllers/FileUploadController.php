<?php

namespace App\Admin\Controllers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController
{
    /**
     * @var Filesystem
     */
    private $storage;

    /**
     * FileUploadController constructor.
     */
    public function __construct()
    {
        $this->storage = Storage::disk('dashboard');
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function upload(Request $request)
    {
        if ($request->file('file')) {
            $path_toFile = $this->storage->putFile('editor_upload', $request->file('file'));
            return json_encode(['location' => $this->storage->url($path_toFile)]);
        }
    }
}