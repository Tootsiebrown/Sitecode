<?php

namespace App\Models\Casts;

class Image
{

    public $file;
    private $path;
    private $meta;

    public function __construct($file, $path, $meta)
    {
        $this->file = $file;
        $this->path = $path;
        $this->meta = $meta;

        $this->init();
    }

    protected function init()
    {
        $this->url = url('storage/uploads/' . $this->path . '/' . $this->file);
    }

    public function url($size)
    {
        // return the URL for a given size
    }
}
