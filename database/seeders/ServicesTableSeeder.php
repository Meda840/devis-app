<?php

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'name' => 'Web Development',
            'description' => 'Full-stack web development service',
            'unit_price' => 500.00,
        ]);

        Service::create([
            'name' => 'Consultation',
            'description' => 'Consultation for business strategy',
            'unit_price' => 200.00,
        ]);

        Service::create([
            'name' => 'SEO Optimization',
            'description' => 'Search engine optimization for better ranking',
            'unit_price' => 300.00,
        ]);
    }
}