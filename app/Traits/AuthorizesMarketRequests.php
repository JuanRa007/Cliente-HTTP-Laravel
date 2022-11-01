<?php

namespace App\Traits;

use App\Services\MarketAuthenticationService;

trait AuthorizesMarketRequests
{
  public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
  {
    // Resolvemos el token de acceso.
    $accessToken = $this->resolveAccessToken();

    // Añadimos dicho token de acceso, a las cabeceras.
    $headers['Authorization'] = $accessToken;
  }

  public function resolveAccessToken()
  {
    // return 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiODc1NzM3NjAyMmIxNzgwNjc3Y2NhYzExOGRiNzdmYTYxMmI5YjkwMDFlNWUxYmY5ZTIwZGEzYThjYzBmYzNmNTk1MmZiOTU4ZmQ4YTdmNmQiLCJpYXQiOiIxNjY2NzE2MTQ1LjI5MzU2MCIsIm5iZiI6IjE2NjY3MTYxNDUuMjkzNTY0IiwiZXhwIjoiMTY5ODI1MjE0NS4yODg1NjMiLCJzdWIiOiIxMjY0Iiwic2NvcGVzIjpbInB1cmNoYXNlLXByb2R1Y3QiLCJtYW5hZ2UtcHJvZHVjdHMiLCJtYW5hZ2UtYWNjb3VudCIsInJlYWQtZ2VuZXJhbCJdfQ.0FsRI9sbDuprkKDtilJEmf4UJFnnSMaUyR1hdwhc_EeKJXqnOasUJu4T5Zthd-9KVnJq3799xdmM7BrZ43mXZ0lsHIkdX1GyF4U1TBZ7TwtxeNn_Wol0-KqQn0TjZxU528qBF8S71bP2O-jj2BNNt32b6V1ZbnXLVu4SQfEMFPCSj_ONtsEqBoDK_5pkLIvDDKMz8eOLyxT80O-rsz2MuNvoxDGwTTdCopXprtRDlkwqO5NwbY99aVqm_A3IsLhhS3m0BnwP6vIrypBdpw3ear-nIg9TF--R-AKpdOuUeChS6gpjbHAEriRmguLcDccLieMIr7kT6jg3lO-tinz3pv_uRE3SW2W3ycPXLdeloGet8Zlp1okVB0G8XdJT8ChP3PMhfEPycXDpwMXsgwTLkoGiAur4JFcijYDmMyZVDtLsDV8yQFAigRqawvLuo0ZK__k2Hq2ExEgQFecTTOSLACKuWmH63OjpazB_gnoIvUs6vuJ28W3iVbuNIH7okibDWtej8p9B-c2XhKlhjVv9SGpmi5N9AO21NYrO6M4Xh9lF2as56RpEY65RJt-x0c0_1RIKMoFlEmBzSlD2P2m_-d6WQa2W1HVXwWLoQdHcPwJPuM8XNRqazo0lQ7poEkeqXr7f4Ajj-0cmCHzk3tjMBYcVQjyV3j7BJiZWyp4qyg4';

    $authenticationService = resolve(MarketAuthenticationService::class);

    return $authenticationService->getClientCredentialsToken();
  }
}
