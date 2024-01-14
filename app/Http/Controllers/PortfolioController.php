<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PortfolioController extends Controller {
    public function getPortfolio() {
        $portfolios = Portfolio::query()->select('id','title','description','cover_photo','url')->get();

        return $this->apiSuccessResponse(PortfolioResource::collection($portfolios), 'Portfolios retrieved successfully');
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

        return $this->apiSuccessResponse(new PortfolioResource($portfolio), 'Portfolio updated successfully');
    }

    public function destroyProject(Portfolio $portfolio) {
        File::delete('uploaded-files/' . $portfolio->cover_photo);

        $portfolio->delete();

        return $this->apiSuccessResponse([], 'Portfolio deleted successfully');
    }
}
