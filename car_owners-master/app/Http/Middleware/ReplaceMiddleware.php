<?php

namespace App\Http\Middleware;

use App\Models\ShortCode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplaceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $content = $response->getContent();
        foreach (ShortCode::all() as $code){
            $content=str_replace("[[$code->name]]", $code->value, $content);
        }

        $response->setContent($content);

        return $response;
    }
}
