<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plant;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plant::insert([
            ['name' => 'Mango Tree', 'location' => 'Angeles Zone I, Tayabas City'],
            ['name' => 'Banana Plant', 'location' => 'Angeles Zone I, Tayabas City'],
            ['name' => 'Coconut Tree', 'location' => 'Angeles Zone IV, Tayabas City'],
            ['name' => 'Papaya Plant', 'location' => 'Angeles Zone II, Tayabas City'],
            ['name' => 'Guava Tree', 'location' => 'Angeles Zone III, Tayabas City'],
        ]);
    }
}
