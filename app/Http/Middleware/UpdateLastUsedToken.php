<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastUsedToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Session::get('tkn')) {
            try {
                $encryptedToken = Session::get('tkn');
                $decryptedToken = Crypt::decrypt($encryptedToken);
                $tokenId = Str::before($decryptedToken, '|');

                $token = Auth::user()->tokens()->where('id', $tokenId)->first();

                if ($token) {
                    if ($token->expires_at && $token->expires_at->isPast()) {
                        $token->delete();

                        $request->session()->invalidate();
                        $request->session()->regenerateToken();

                        return redirect()->route('login')->with('tkn_exp', 'Token has expired. Please log in again.');
                    }

                    Auth::user()->tokens()->where('id', $tokenId)->update([
                        'last_used_at' => Carbon::now(),
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Token',
                ], 401);
            }
        }

        return $next($request);
    }
}
