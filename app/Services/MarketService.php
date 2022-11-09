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


  public function publishProduct($sellerId, $productData)
  {
    return $this->makeRequest(
      'POST',
      "sellers/{$sellerId}/products",
      [],
      $productData,
      [],
      $hasFile = true
    );
  }

  public function setProductCategory($productId, $categoryId)
  {
    return $this->makeRequest(
      'PUT',
      "products/{$productId}/categories/{$categoryId}",
    );
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

  // Obtenemos los productos de una categoría.
  public function getUserInformation()
  {
    return $this->makeRequest('GET', "users/me");
  }
}
