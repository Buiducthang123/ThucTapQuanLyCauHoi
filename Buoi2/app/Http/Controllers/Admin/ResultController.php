<?php

namespace App\Http\Controllers\Admin;

use App\Services\ResultService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResultController
{
    protected $resultService;
    public function __construct(ResultService $resultService)
    {
        $this->resultService = $resultService;
    }
    function create(Request $request)
    {
        $time_start = Carbon::now();
        $time_end = Carbon::now()->addHour();
        $user_id = auth()->id();
        $a = json_decode($request->data);
        $test_id = $a->test_id;


        $this->resultService->create([
            'test_id' => $test_id,
            'user_id' => $user_id,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'status'=>0
        ]);
        return [$test_id, $user_id,
            $time_start->format('Y-m-d H:i:s'),
            $time_end->format('Y-m-d H:i:s'),
        ];

    }
}
