<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->warn('Nenhuma empresa encontrada. Execute o CompanySeeder primeiro.');
            return;
        }

        foreach ($companies as $company) {
            Category::factory()->count(5)->create([
                'company_id' => $company->id,
            ]);

            $this->command->info("Criadas 5 categorias para empresa {$company->id}");
        }
    }
}
