<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Carbon;

class UserRepository extends BaseRepository implements UserRepositoryInterface{

    function getModel(){
        return User::class;
    }

    //Lấy ra danh sach user có sinh nhật ngày hôm nay
    function getBD(){
        $currentDay = Carbon::today()->format('d');
        $currentMonth = Carbon::today()->format('m');
        $results = $this->model->select('name','Sn','email')->whereMonth('Sn', $currentMonth)
        ->whereDay('Sn', $currentDay)
        ->get();
        return $results;
    }

}
