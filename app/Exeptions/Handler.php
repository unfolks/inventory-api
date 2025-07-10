<?php

use Illuminate\Auth\AuthenticationException;

class Handler
{
    public function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Token tidak valid atau tidak dikirim'
            ], 401);
        }

        return redirect()->guest(route('login'));
    }
}
