<?php

namespace App\Services;

use App\Traits\AuthorizesMarketRequests;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketService
{

  use ConsumesExternalServices, AuthorizesMarketRequests, InteractsWithMarketResponses;

  // Dirección API leída de ENV.
  protected $baseUri;

  public function __construct()
  {
    $this->baseUri = config('services.market.base_uri');
  }

  // Probando la llamada a la API
  // Obtenemos los productos
  public function getProducts()
  {
    return $this->makeRequest('GET', 'products');
  }

  // Obtenemos un producto específico.
  public function getProduct($id)
  {
    return $this->makeRequest('GET', "products/{$id}");
  }

  // Obtenemos las categorías
  public function getCategories()
  {
    return $this->makeRequest('GET', 'categories');
  }

  // Obtenemos los productos de una categoría.
  public function getCategoryProducts($id)
  {
    return $this->makeRequest('GET', "categories/{$id}/products");
  }
}
