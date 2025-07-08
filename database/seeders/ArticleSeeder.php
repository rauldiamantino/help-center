<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Company;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->warn('Nenhuma empresa encontrada. Execute o CompanySeeder primeiro.');
            return;
        }

        foreach ($companies as $company) {
            $users = $company->users;
            $categories = $company->categories;

            if ($users->isEmpty()) {
                $this->command->warn("Empresa {$company->id} não possui usuários.");
                continue;
            }

            if ($categories->isEmpty()) {
                $this->command->warn("Empresa {$company->id} não possui categorias.");
                continue;
            }

            for ($i = 1; $i <= 30; $i++) {
                Article::factory()->create([
                    'company_id' => $company->id,
                    'user_id' => $users->random()->id,
                    'category_id' => $categories->random()->id,
                ]);
            }

            $this->command->info("Criados 30 artigos para empresa {$company->id}");
        }
    }
}
