<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            [
                'icon' => 'ticket', // You can replace with icon name or path
                'heading' => 'Ultimate flexibility',
                'description' => 'You\'re in control, with free cancellation and payment options to satisfy any plan or budget.',
            ],
            [
                'icon' => 'hot-air-balloon',
                'heading' => 'Memorable experiences',
                'description' => 'Browse and book tours and activities so incredible, you\'ll want to tell your friends.',
            ],
            [
                'icon' => 'diamond',
                'heading' => 'Quality at our core',
                'description' => 'High-quality standards. Millions of reviews. A tourz company.',
            ],
            [
                'icon' => 'award',
                'heading' => 'Award-winning support',
                'description' => 'New price? New plan? No problem. We\'re here to help, 24/7.',
            ],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
