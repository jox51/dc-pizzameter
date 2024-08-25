<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pizzaLocations = [
            'ChIJ90LLZm24t4kRjBkPGGEmK0w',
            'ChIJae6p-5S3t4kRtD-SmqhTqEA',
            'ChIJoxUp5-e3t4kR6LQ1sddDy6Q',
            'ChIJzQBiHEm2t4kRQwxk-OSBaD8',
            'ChIJiRsMcTKxt4kRb9rj3ZyTt-M',
            'ChIJl20zyBPIt4kRXQ_TsxLVyZo',
            'ChIJBWMj3EG4t4kRTAsMfldWe2g',
            'ChIJC5rypw-5t4kRPKnL7rfgAU4',
            'ChIJD_T9c3-2t4kRqPxa2Ec-IQ8',
            'ChIJe7uJcB2xt4kRq7IqXzZ1_CA',
            'ChIJET3zDcu5t4kRhVREoQpIQEs',
            'ChIJfYKodBC5t4kRPSVP6F7fpqE',
            'ChIJi-dXi4u3t4kRViIFlCcxecU',
            'ChIJo03BaX-3t4kRbyhPM0rTuqM',
            'ChIJoYwYOyyxt4kRoBLQ1Wck5Ug',
            'ChIJi8UzSoi2t4kRFeR391zS80I'
        ];

        $barLocations = [
            'ChIJT0nz-WWxt4kRCVLKdzydHBI',
            'ChIJ483JU9C3t4kR9MXIlLTy00Y',
            'ChIJtzUFhjq3t4kRy74evWfyOfM',
            'ChIJcfrqUU63t4kRkd7foZeu1Yw',
            'ChIJt8DYq4W2t4kRDx-oSR60yHc',
            'ChIJky8muym3t4kRNk3dwZ3cEaU',
            'ChIJpwoZ5OG3t4kRBqwxYRIAj-o',
            'ChIJfwVroeW3t4kRPqFvM6RDkwM',
            'ChIJQZxM4vG3t4kRRd7V3ReX6ek',
            'ChIJeZk6bDK4t4kRHzg_zs4b93Q',
            'ChIJbwUdjH63t4kR9_gS9lEMU8A',
            'ChIJmUEaG-23t4kRb1enc-7KsP0',
            'ChIJm5jJQx24t4kR4UDzgxeCSTQ',
            'ChIJ79_J5ru3t4kRAvmLRiUO6tU'
        ];

        foreach ($pizzaLocations as $placeId) {
            Location::create([
                'place_id' => $placeId,
                'type' => 'pizza'
            ]);
        }

        foreach ($barLocations as $placeId) {
            Location::create([
                'place_id' => $placeId,
                'type' => 'bar'
            ]);
        }
    }
}