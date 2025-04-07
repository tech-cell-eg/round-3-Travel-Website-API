<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketTypes = [
            ['name' => 'Adult', 'age_min' => 18, 'age_max' => 999],
            ['name' => 'Youth', 'age_min' => 13, 'age_max' => 17],
            ['name' => 'Children', 'age_min' => 0, 'age_max' => 12],
        ];

        foreach ($ticketTypes as $type) {
            TicketType::create($type);
        }
    }
}