<?php

namespace Database\Seeders;

use App\Enum\ActionTypeStatus;
use App\Models\ActionType;
use App\Models\Booster;
use Illuminate\Database\Seeder;

class BoosterSeeder extends Seeder
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var \Illuminate\Support\Carbon
     */
    private $time_frame;
    /**
     * @var mixed
     */
    private $point;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Booster::truncate();
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
            $saveType = new Booster();
            $saveType->action_type = ActionType::inRandomOrder()->take(1)->first()->id;
            $saveType->time_frame = now()->addMonth(rand(1,5));
            $saveType->point = $type['point'];
            $saveType->save();
        }
    }
}
