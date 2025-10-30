<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MsoServer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $response = Http::timeout(5)->get(config('services.mso.base_url'));
        } catch (\Exception $e) {
            Log::error('MsoStatus: ', [
                'url'     => config('services.mso.base_url'),
                'message' => $e->getMessage(),
                'route'   => $request->path(),
                'ip'      => $request->ip(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Tidak dapat terhubung ke server MSO',
            ], 500);
        }

        if (! $response->successful()) {
            Log::warning('MsoStatus: ', [
                'url'     => config('services.mso.base_url'),
                'status'  => $response->status(),
                'body'    => $response->body(),
                'route'   => $request->path(),
                'ip'      => $request->ip(),
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Server MSO mengembalikan error',
                'code'    => $response->status(),
            ], 500);
        }

        return $next($request);
    }
}
