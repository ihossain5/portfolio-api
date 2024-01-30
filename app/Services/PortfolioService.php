<?php

namespace App\Services;

use App\Actions\ImageUpload;
use App\Actions\PortfolioCreateOrUpdate;
use App\Models\Portfolio;
use Illuminate\Support\Facades\File;

class PortfolioService {

    protected $portfolio;

    public function __construct(Portfolio $portfolio) {
        $this->portfolio = $portfolio;
    }

    public function allPortfolios() {
        return $this->portfolio->query()->select('id', 'title', 'description', 'cover_photo', 'url')->get();
    }

    public function store($validatedData) {

        $validatedData['cover_photo'] = (new ImageUpload())->handle($validatedData['cover_photo']);

        return (new PortfolioCreateOrUpdate())->handle($validatedData);
    }

    public function update($portfolio, $validatedData) {

        if (array_key_exists('cover_photo', $validatedData)) {
            File::delete('uploaded-files/' . $portfolio->cover_photo);

            $validatedData['cover_photo'] = (new ImageUpload())->handle($validatedData['cover_photo']);
        }

        return (new PortfolioCreateOrUpdate())->handle($validatedData, $portfolio);
    }

    public function delete($portfolio) {
        File::delete('uploaded-files/' . $portfolio->cover_photo);

        return $portfolio->delete();
    }
}