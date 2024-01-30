<?php

namespace App\Actions;

use App\Models\Portfolio;

class PortfolioCreateOrUpdate {

    public function handle(array $data, ?Portfolio $portfolio = null): Portfolio {
       
        return $portfolio
        ? tap($portfolio)->update($data)
        : Portfolio::create($data);
    }
}