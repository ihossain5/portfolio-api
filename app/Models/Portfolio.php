<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title','cover_photo','description','url'];

    protected function coverPhoto(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => url("uploaded-files/{$value}"),
        );
    }
}
