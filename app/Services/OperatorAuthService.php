<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Operator;
use App\Models\Publisher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class OperatorAuthService
{
    private $operator;

    public function __construct(Operator $operator)
    {
        $this->operator = $operator;
    }

    public function login($data)
    {
        $operator = $this->operator
            ->where('email', $data["email"])
            ->first();

        if (!$operator) {
            throw new \Exception("Credentials not match");
        }

        if(!$operator->is_active){
            throw new \Exception("Your account is not active");
        }

        if (!$operator || !Hash::check($data["password"], $operator["password"])) {
            throw new \Exception("Credentials not match");
        }

        // if($operator->role_id == Rol::PUBLISHER && $this->publisherDueDate($operator->id)){
        //     throw new PublisherDueDateException("Your account has expired");
        // }

        return $this->handleResponse($operator);
    }

    // public function publisherDueDate(int $operatorId): bool
    // {
    //     $publisher = Publisher::where('operator_id', $operatorId)->first();
    //     return $publisher->due_date && $publisher->due_date < now();
    // }

    protected function handleResponse($user)
    {
        // $token = substr(Crypt::encrypt($user->email . '_' . Carbon::now()->format('Ymdhis')), 0, 60);
        // $user->update([
        //     'api_token' => $token
        // ]);

        return [
            'token' => $user->api_token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id
            ]
        ];
    }
}
