<?php

namespace App\Traits;

trait InteractsWithMarketResponses
{
  public function decodeResponse($response)
  {
    // Decodificamos la respuesta
    $decodeResponse = json_decode($response);

    // Si nos llega una respuesta con data, la devolvemos; si no, toda la respuesta.
    return $decodeResponse->data ?? $decodeResponse;
  }

  public function checkIfErrorResponse($response)
  {
    // Existen muchas respuestas de error y depende de cada API solicitada.
    if (isset($response->error)) {
      // Generamos una excepción genérica.
      throw new \Exception("Something failed: {$response->error}");
    }
  }
}
