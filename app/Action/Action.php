<?php

namespace App\Action;

use \App\Models\Action as ActionModel;
use App\Enum\ActionTypeStatus;
use App\Helper\UserHelper;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Action
{
    public function run()
    {
        $counter = 0;
        $actions = self::getUserActions()['actions'];
        $count_action = count($actions);
        $results = [];
        foreach ($actions as $x => $action){
            if($x = 0){
                $date = 0;
            }else{
                $date= $x;
            }
            $startTime = Carbon::parse($actions[$date]['time']);
            $endTime = Carbon::parse($actions[$date + 1]['time']);
            if($startTime->diffInHours($endTime) > 2){
                    $counter +=1;
                    $point = 5;
                    $status  = 'expired';
                 $type =  $actions[$x]['type']['name']." in ".Carbon::parse($actions[$x]['time'])->diffForHumans();
            }else{
                $counter = 1;
                $point = 1;
                $type =  $actions[$x]['type']['name']." on ".Carbon::parse($actions[$x]['time'])->format('M, d H:i');
                $status  = 'valid';
            }
            $results[] = [
                'date' => $type,
                'point' => $point,
                'status' => $status,
            ];
        }
            $results[] = [
                'date' => $type,
                'point' => $point,
                'status' => $status,
            ];
        return $results;
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

        $actions = ActionModel::whereUserId($user->id)->latest()->with('type')->take(11)->get()->toArray();
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

}
