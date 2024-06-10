<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Events\UserAvatars;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'password' => $this->passwordRules(),
            'gender' => ['nullable', 'string'],
            'birthday' => ['required', 'date'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'username' => ['required', 'string'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'gender' => $input['gender'],
            'birthday' => $input['birthday'],
            'country' => $input['country'],
            'city' => $input['city'],
            'username' => $input['username'],
        ]);

        $user->is_online = true;
        $user->last_online_at = now();
        $user->save();

        event(new UserAvatars($user));
        return $user;

    }
}
