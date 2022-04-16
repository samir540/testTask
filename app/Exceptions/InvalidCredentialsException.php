<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialsException extends Exception
{
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request)
    {
        return response()->json(['message' => $this->getMessage(), 'errors' => ['credentials' => 'Invalid Credentials']], 422);
    }
}
