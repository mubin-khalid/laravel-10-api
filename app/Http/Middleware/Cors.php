<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {            
            $origin = $request->header('origin');
            $origin = $origin ?? '*';
    
            // ALLOW OPTIONS METHOD
            $headers = [
                'Access-Control-Allow-Origin' => $origin,
                'Access-Control-Allow-Methods'=> 'GET, POST, DELETE, PUT, OPTIONS, HEAD, PATCH',
                'Access-Control-Allow-Headers'=> 'Authorization,DNT,X-CustomHeader,Keep-Alive,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Set-Cookie',
                'Access-Control-Allow-Credentials'=> 'true'
            ];
    
            if($request->getMethod() == "OPTIONS") {
                // The client-side application can set only headers allowed in Access-Control-Allow-Headers
                return Response::make('OK', 200, $headers);
            }
    
            $response = $next($request);
    
            foreach($headers as $key => $value) {
                $response->header($key, $value);
            }
            return $response;
        }
    }
}
