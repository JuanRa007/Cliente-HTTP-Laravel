<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketService $marketService)
    {
        $this->middleware('auth')->except(['showProduct']);

        parent::__construct($marketService);
    }


    public function showProduct($title, $id)
    {
        $product = $this->marketService->getProduct($id);

        return view('products.show')->with([
            'product' => $product
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function purchaseProduct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showPublishProductForm()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function publishProduct(Request $request)
    {
    }
}
