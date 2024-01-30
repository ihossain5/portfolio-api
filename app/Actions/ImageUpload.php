<?php

namespace App\Actions;
use Illuminate\Support\Str;

class ImageUpload {
    public function handle($coverPhoto) {

        $coverPhotoPath  = 'portfolio/' . now()->format('YmdHis') . '_' . Str::slug($coverPhoto->getClientOriginalName()) . '.' . $coverPhoto->getClientOriginalExtension();

        $coverPhoto->move('uploaded-files/portfolio/', $coverPhotoPath);

        return $coverPhotoPath;
    }
}