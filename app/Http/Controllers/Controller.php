<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    // Añadimos nuestro controlador.
    protected $marketService;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(MarketService $marketService)
    {
        $this->marketService = $marketService;
    }
}
