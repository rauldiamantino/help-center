<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->warn('Nenhuma empresa encontrada. Execute o CompanySeeder primeiro.');
            return;
        }

        foreach ($companies as $company) {
            User::factory()->count(5)->create([
                'company_id' => $company->id,
            ]);

            $this->command->info("Criados 5 usuários para empresa {$company->id}");
        }
    }
}
