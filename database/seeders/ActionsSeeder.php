<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\ActionType;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1,50) as $actions){
            $action = new Action();
            $action->action_type = ActionType::inRandomOrder()->take(1)->first()->id;
            $action->user_id = User::inRandomOrder()->take(1)->first()->id;
            $action->time = now()->addHour(4);
            $action->save();

        }
    }
}
