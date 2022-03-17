<?php

namespace App\Action;

use App\Enum\ActionTypeStatus;
use App\Helper\UserHelper;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Action
{
    protected $delivery;
    protected $redishare;
    protected $rent;

    public function __construct($delivery, $redishare, $rent)
    {
        $this->delivery = $delivery;
        $this->redishare = $redishare;
        $this->rent = $rent;
    }


    public function run()
    {
        $counter = 0;
        $actions = self::getUserActions()['point'];
        for ($x = 0; $x <= count($actions); $x++){
            if($counter === 5 && Carbon::diffInHours([$x], [$x+1]) < 2){
                $counter +=1;
                $x = $x + 1;
            }else{
                $counter = 1;
                $x = 1;
            }
        }
    }

    /**
     * @throws Exception
     */
    private static function getUser($id)
    {
        try {
            return User::where('id', $id)->first();
        }catch (ModelNotFoundException $exception){
            throw new ModelNotFoundException('Email not found.', $exception->getMessage());
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    private static function getUserActions()
    {
        $user = UserHelper::getARandomUser();

        $actions = \App\Models\Action::whereUserId($user->id)->get()->toArray();
        $point = [];
        foreach ($actions as $action) {
            if($action['action_type'] === ActionTypeStatus::Delivery){
                $point[] = ActionTypeStatus::DeliveryValue;
            }elseif($action['action_type'] === ActionTypeStatus::Rideshare){
                $point[] = ActionTypeStatus::RideshareValue;
            }else{
                $point[] = ActionTypeStatus::RentValue;
            }
        }
        return [
            'actions' => $actions ?? [],
            'point' => $point,
            'user' => $user
        ];
    }

    //if counter equal to 5 ;
//            if carbon::diffInHours($data[x], $data[x+1]) < 2;
//              $count +=1;
//              $x = $x + 1;

//$data[$x+1] = $x->diffInHours(2);
}
