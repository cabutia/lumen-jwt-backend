<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware {

  public function handle($request, Closure $next)
  {
    $response = $next($request);
    $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
    $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
    $response->header('Access-Control-Allow-Origin', '*');
    if ($request->isMethod('OPTIONS'))
    {
        $response->setStatusCode(200);
        $response->setContent('OK');
     }
    return $response;
  }

}
