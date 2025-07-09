<?php

namespace App\Actions\Fortify;

use Exception;
use App\Models\User;
use App\Models\Company;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CompanyUserRegistration implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        $validated = $this->validate($input);

        DB::beginTransaction();

        try {
            $company = $this->createCompany($validated);
            $user = $this->createUser($validated, $company->id);

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function validate(array $input): array
    {
        return Validator::make($input, [
            'company_name' => [
                'required',
                'string',
                'max:255',
                'unique:companies,name',
            ],
            'company_slug' => [
                'required',
                'string',
                'max:255',
                'unique:companies,slug',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : [],
        ])->validate();
    }

    private function createCompany(array $validated): Company
    {
        return Company::create([
            'name' => $validated['company_name'],
            'slug' => Str::slug($validated['company_slug']),
        ]);
    }

    private function createUser(array $validated, int $companyId): User
    {
        return User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'company_id' => $companyId,
            'role' => 1,
        ]);
    }
}
