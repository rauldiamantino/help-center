<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::factory()->count(10)->create();
        $this->command->info('Criadas 10 empresas');
    }
}
