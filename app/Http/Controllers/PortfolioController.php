<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PortfolioController extends Controller {
    public function getPortfolio() {
        $portfolios = Portfolio::all();

        $transformedPortfolios = $portfolios->map(function ($portfolio) {
            return [
                'id'          => $portfolio->id,
                'title'       => $portfolio->title,
                'description' => $portfolio->description,
                'cover_photo' => $portfolio->cover_photo,
            ];
        });

        return $this->apiSuccessResponse($transformedPortfolios, 'Portfolios retrieved successfully');
    }

    public function storeProject(PortfolioRequest $request) {
        $validatedData                = $request->validated();
        $coverPhoto                   = $request->file('cover_photo');
        $coverPhotoPath               = 'portfolio/' . now()->format('YmdHis') . '_' . Str::slug($coverPhoto->getClientOriginalName()) . '.' . $coverPhoto->getClientOriginalExtension();
        $validatedData['cover_photo'] = $coverPhotoPath;

        $coverPhoto->move('uploaded-files/portfolio/', $coverPhotoPath);

        $data = Portfolio::create($validatedData);

        return $this->apiSuccessResponse($data, 'Portfolio created successfully', 201);

    }

    public function updateProject(PortfolioRequest $request, Portfolio $portfolio) {
        $validatedData = $request->validated();

        if ($request->hasFile('cover_photo')) {
            File::delete('uploaded-files/' . $portfolio->cover_photo);

            $coverPhoto                   = $request->file('cover_photo');
            $coverPhotoPath               = 'portfolio/' . now()->format('YmdHis') . '_' . Str::slug($coverPhoto->getClientOriginalName()) . '.' . $coverPhoto->getClientOriginalExtension();
            $validatedData['cover_photo'] = $coverPhotoPath;
            $coverPhoto->move('uploaded-files/portfolio/', $coverPhotoPath);
        }

        $portfolio->update($validatedData);

        return $this->apiSuccessResponse($portfolio, 'Portfolio updated successfully', 200);
    }

    public function destroyProject(Portfolio $portfolio) {
        File::delete('uploaded-files/' . $portfolio->cover_photo);

        $portfolio->delete();

        return $this->apiSuccessResponse([], 'Portfolio deleted successfully', 200);
    }
}
