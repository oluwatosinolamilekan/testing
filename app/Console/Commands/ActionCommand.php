<?php

namespace App\Console\Commands;

use App\Action\Action;
use App\Enum\ActionTypeStatus;
use Illuminate\Console\Command;

class ActionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'action:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
    You are developing the “Incentives Program”. Users can earn bonus points by performing specific actions. At the moment, there are three types of actions. Each of them results in a different amount of points which user receives:
    - delivery: 1 point for every action
    - rideshare: 1 point for every action
    - rent: 2 points per day of the duration.
    There are also boosters in the system. Users can earn more points by doing “X” actions in a “Z” time frame. For example:
    - 5 deliveries in 2 hours result in 5 additional points.
    - 5 rideshares in 8 hours result in 10 additional points.
    - Rent has no boosters.
    Each booster is connected to a specific action type. So boosters for deliveries don’t apply to rideshares.
    Each action can be part of only one booster, and boosters can be active only at a specific time. The system will be extended with new boosters in the future.
    Points can have an expiry date. For example, points from boosters are valid only for one month and then lost unless the user withdraws them before the expiry date. Points for actions don’t expire at the moment. Users can cash out points with an exchange rate of 1 point equals 1 dollar.
    For example:
    Mark did seven deliveries in 2 hours, three rideshares in 4 hours, and rented a book for three days. His current balance is 21. After a month, his balance would shrink to 16.
    Please follow the below:
    ● Write a code that calculates a user's balance at any given point in time.
    ● Document your decisions.
    ● Focus on the readability of the code.
    ● Follow the best industry practices.
    ● Please add test cases.
    If you have any questions, don't hesitate to ask. Please put your code online as a snippet, git repository, gist, etc.
     */

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $actions = (new Action())->run();
        $headers = ['Actions','Point','Status',];
        $this->table($headers,$actions);
//        $this->info('done');
    }
}
