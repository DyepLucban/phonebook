<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\ValidationException;

final class Login
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $userRecord = User::where('email', $args['email'])->first();

        if (!$userRecord || !Hash::check($args['password'], $userRecord->password)) {
            // throw ValidationException::withMessages([ 'message' => ['Invalid credentials'] ]);
            dd('test');
        }

        return $userRecord->createToken($args['device_name'])->plainTextToken;
    }
}
