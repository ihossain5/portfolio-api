<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioRequest;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use App\Services\PortfolioService;

class PortfolioController extends Controller {

    public $portfolioService;

    public function __construct(PortfolioService $portfolioService) {
        $this->portfolioService = $portfolioService;
    }

    public function getPortfolio() {

        $portfolios = $this->portfolioService->allPortfolios();

        return $this->apiSuccessResponse(PortfolioResource::collection($portfolios), 'Portfolios retrieved successfully');
    }

    public function storeProject(PortfolioRequest $request) {

        $data =  $this->portfolioService->store($request->validated());

        return $this->apiSuccessResponse($data, 'Portfolio created successfully', 201);

    }

    public function updateProject(PortfolioRequest $request, Portfolio $portfolio) {

        $data =  $this->portfolioService->update($portfolio, $request->validated());

        return $this->apiSuccessResponse(new PortfolioResource($data), 'Portfolio updated successfully');
    }

    public function destroyProject(Portfolio $portfolio) {
        
        $this->portfolioService->delete($portfolio);

        return $this->apiSuccessResponse([], 'Portfolio deleted successfully');
    }
}
