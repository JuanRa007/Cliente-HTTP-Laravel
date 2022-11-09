<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{

  /**
   * Send a request to any service
   * @return string
   */
  public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $hasFile = false)
  {

    // Dirección base del API
    $client = new Client(
      [
        'base_uri' => $this->baseUri,
      ]
    );

    // 
    if (method_exists($this, 'resolveAuthorization')) {
      $this->resolveAuthorization($queryParams, $formParams, $headers);
    }

    // Para poder enviar ficheros.
    $bodyType = 'form_params';

    if ($hasFile) {
      $bodyType = 'multipart';

      $multipart = [];

      foreach ($formParams as $name => $contents) {
        $multipart[] = ['name' => $name, 'contents' => $contents];
      }
    }

    // Enviamos la petición
    $response = $client->request($method, $requestUrl, [
      'query'     => $queryParams,
      $bodyType   => $hasFile ? $multipart : $formParams,
      'headers'   => $headers
    ]);

    // Nos llegará una respuesta ya que GuzzleHttp generará una excepción si hay un error y no se
    // ejecutará nada a partir de aquí.
    $response = $response->getBody()->getContents();

    // ¿Cómo nos llegan los datos?. Le preguntamos a la API.
    if (method_exists($this, 'decodeResponse')) {
      $response = $this->decodeResponse($response);
    }

    // Puede que devuelva una respuesta aunque haya fallado.
    if (method_exists($this, 'checkIfErrorResponse')) {
      $this->checkIfErrorResponse($response);
    }

    return $response;
  }
}
