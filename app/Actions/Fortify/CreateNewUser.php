<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
       
        $data=Validator::make($input, [
            'name' => ['required', 'string', 'min:2'],
            'manager_name' => ['required', 'string', 'min:4'],
            'phone' => ['required', 'string','digits:10'],
            'adress' => ['required', 'string','min:4'],
            'location' => ['required', 'string','min:20'],
            'category' => ['required', 'string','min:2'],
            'description' => ['required', 'string','min:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        
        
        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'manager_name' => $input['manager_name'],
                'phone' => $input['phone'],
                'adress' => $input['adress'],
                'location' => $input['location'],
                'category' => $input['category'],
                'description' => $input['description'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });
        });
    }

    /** 
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]." équipe ",
            'personal_team' => true,
        ]));
    }
}