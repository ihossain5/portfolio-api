<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller {
    public function getPortfolio() {
        return Portfolio::all();
    }

    public function storeProject(PortfolioRequest $request) {
        $validatedData                = $request->validated();
        $coverPhoto                   = $request->file('cover_photo');
        $coverPhotoPath               = 'portfolio/' . now()->format('YmdHis') . '_' . Str::slug($coverPhoto->getClientOriginalName()) . '.' . $coverPhoto->getClientOriginalExtension();
        $validatedData['cover_photo'] = $coverPhotoPath;
        Storage::disk('public')->put($coverPhotoPath, file_get_contents($coverPhoto));

        Portfolio::create($validatedData);

        return true;
    }

    public function updateProject(PortfolioRequest $request, Portfolio $portfolio) {
        $validatedData = $request->validated();

        if ($request->hasFile('cover_photo')) {
            Storage::disk('public')->delete($portfolio->cover_photo);

            $coverPhoto                   = $request->file('cover_photo');
            $coverPhotoPath               = 'portfolio/' . now()->format('YmdHis') . '_' . Str::slug($coverPhoto->getClientOriginalName()) . '.' . $coverPhoto->getClientOriginalExtension();
            $validatedData['cover_photo'] = $coverPhotoPath;
            Storage::disk('public')->put($coverPhotoPath, file_get_contents($coverPhoto));
        }

        $portfolio->update($validatedData);

        return true;
    }

    public function destroyProject(Portfolio $portfolio) {
        Storage::disk('public')->delete($portfolio->cover_photo);

        $portfolio->delete();

        return true;
    }
}
