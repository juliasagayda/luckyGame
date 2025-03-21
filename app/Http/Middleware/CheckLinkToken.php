<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\LinkService;


class CheckLinkToken
{
    protected $linkService;

    public function __construct(LinkService $linkService)
    {
        $this->linkService = $linkService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('token')) {
            $token = session('token');
            
            if (!$this->linkService->findLinkByToken($token)) {
                session()->forget('token');
                return redirect()->route('register.form')->with('error', 'Invalid or expired link');
            }
    
            return $next($request);
        }
    
        return $next($request);
    }
}
