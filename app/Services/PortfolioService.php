<?php

namespace App\Services;

use App\Actions\ImageUpload;
use App\Actions\PortfolioCreateOrUpdate;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;

class PortfolioService {

    public function allPortfolios(): Collection {
        return Portfolio::query()->select('id', 'title', 'description', 'cover_photo', 'url')->get();
    }

    public function store(array $validatedData): Portfolio {

        $validatedData['cover_photo'] = (new ImageUpload())->handle($validatedData['cover_photo']);

        return (new PortfolioCreateOrUpdate())->handle($validatedData);
    }

    public function update($portfolio, array $validatedData): Portfolio {

        if (array_key_exists('cover_photo', $validatedData)) {
            $this->deleteCoverPhoto($portfolio->cover_photo);

            $validatedData['cover_photo'] = (new ImageUpload())->handle($validatedData['cover_photo']);
        }

        return (new PortfolioCreateOrUpdate())->handle($validatedData, $portfolio);
    }

    public function delete($portfolio): bool {
        $this->deleteCoverPhoto($portfolio->cover_photo);

        return $portfolio->delete();
    }

    protected function deleteCoverPhoto($cover_photo){
        return File::delete('uploaded-files/' . $cover_photo);
    }
}