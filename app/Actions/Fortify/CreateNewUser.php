<?php

namespace App\Actions\Fortify;

use App\Models\Department;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
        dd($input);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'department_id' => ['nullable', 'exists:departments,id'], // التأكد من وجود الـ department_id
        ])->validate();


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'department_id' => isset($input['department_id']) ? $input['department_id'] : null, // تعيين القسم إذا كان موجودًا
        ]);

        // تعيين الدور للمستخدم
        if (isset($input['role']) && $input['role'] == 'admin') {
            $user->assignRole('admin');
        } else {
            // تعيين الدور الافتراضي، يمكن أن يكون "user" أو غيره
            $user->assignRole('admin');
        }

        return $user;
    }
}
