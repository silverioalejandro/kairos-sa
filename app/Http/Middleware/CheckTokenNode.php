<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Publisher;
use App\Exceptions\InvalidTokenException;

class CheckTokenNode
{
    public function handle($request, Closure $next)
    {
        try {
            $input = $request;
            $token = ($input->bearerToken() ?? (isset($input["token"]) ? $input["token"] : null));

            if (is_null($token)) {
                throw new InvalidTokenException("Invalid token");
            };

            if ($token != config('services.api_syndication_parser_go.token')){
                throw new InvalidTokenException("Operator does not work");
            }

            return $next($request);
        } catch (InvalidTokenException $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
    }

    public function publisherDueDate(int $id): bool
    {
        $publisher = Publisher::where('operator_id', $id)->first();
        return $publisher->due_date && $publisher->due_date < now();
    }
}
