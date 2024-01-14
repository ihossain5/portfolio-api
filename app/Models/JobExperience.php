<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model {
    use HasFactory;

    protected function startDate(): Attribute {
        return Attribute::make(
            get: fn(string $value) => Carbon::parse($value)->format('F Y'),
        );
    }

    protected function endDate(): Attribute {
        return Attribute::make(
            get: fn($value) => $value ? Carbon::parse($value)->format('F Y') : 'Present',
        );
    }
}
