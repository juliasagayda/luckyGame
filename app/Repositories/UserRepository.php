<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Str;



class UserRepository
{
    /**
     * Create a new user with the given username and phone number.
     *
     * @param string $username
     * @param string $phone_number
     * @return \App\Models\User
     */
    public function create(string $username, string $phone_number): ?User
    {
        return  User::create([
            'username' => $username,
            'phonenumber' => $phone_number,
            'password' => bcrypt(Str::random(10)),
        ]);
    }
}
