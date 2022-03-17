<?php

namespace Database\Seeders;

use App\Enum\ActionTypeStatus;
use App\Models\ActionType;
use Illuminate\Database\Seeder;

class ActionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActionType::truncate();
        $types = [
            [
                'name' => 'Delivery',
                'point' => ActionTypeStatus::Delivery
            ],
            [
                'name' => 'RideShare',
                'point' => ActionTypeStatus::RideshareValue
            ],
            [
                'name' => 'Rent',
                'point' => ActionTypeStatus::RentValue
            ]
        ];
        foreach ($types as $type){
            $saveType = new ActionType();
            $saveType->name = $type['name'];
            $saveType->point = $type['point'];
            $saveType->save();
        }
    }
}
