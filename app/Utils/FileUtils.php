<?php

namespace App\Utils;

use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;

class FileUtils
{
    public $file;
    public $link;
    public $size;
    public $extension;
    public $uniqueName;
    public function __construct(object $file)
    {
        $this->file = $file;
        $this->size = $file->getSize();
        $this->uniqueName = uniqid() . "." . $file->extension();
        $this->link = url('storage/images/' . $this->uniqueName);
    }
    public function saveInStorage($toPath = "/public/images"){
        Storage::putFileAs($toPath,$this->file, $this->uniqueName);
    }
}
