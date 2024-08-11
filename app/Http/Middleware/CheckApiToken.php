<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Rol;
use App\Models\Operator;
use App\Models\Publisher;
use App\Exceptions\InvalidTokenException;

class CheckApiToken
{
    public function handle($request, Closure $next)
    {
        try {
            $input = $request;
            $token = ($input->bearerToken() ?? (isset($input["token"]) ? $input["token"] : null));

            if (is_null($token)) {
                throw new InvalidTokenException("Invalid token");
            };

            $operator = Operator::where('token', $token)->first();

            if (!$operator){
                throw new InvalidTokenException("Operator does not work");
            }

            if (!$operator->is_active){
                throw new InvalidTokenException("The token is inactive");
            }

            if($operator->role_id != Rol::SITE){
                if($operator->role_id == Rol::PUBLISHER && $this->publisherDueDate($operator->id)){
                    throw new InvalidTokenException("The token has expired");
                }

                $publisherId = $operator->load("publisher");
                $request->merge(["authId" => $publisherId->publisher->id]);
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
