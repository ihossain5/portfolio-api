<?php

namespace App\Actions;

use App\Models\Portfolio;

class PortfolioCreateOrUpdate {

    public function handle($data, $portfolio = null) {

        if ($portfolio) {
            $portfolio->update($data);
        } else {
            $portfolio = Portfolio::create($data);
        }

        return $portfolio;
    }
}