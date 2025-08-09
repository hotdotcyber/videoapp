<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
 use Illuminate\Support\Str; 

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
public function create(array $input): User
{
    Validator::make($input, [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],

        'channel_name' => ['required', 'string', 'max:100','unique:channels,name'],
        'password' => $this->passwordRules(),
    ])->validate();

    // 🔹 Step 1: Create the user
    $user = User::create([
         'name' => $input['channel_name'],
        'slug' => Str::slug($input['channel_name'], '-'),
        'uid' => uniqid(true),
    ]);

    // 🔹 Step 2: Create a related channel
    $user->channel()->create([
        'name' => $input['name'] . "'s Channel",
        'slug' => Str::slug($input['name'], '-'),
        'uid' => uniqid(true),
    ]);

    return $user;
}

}
