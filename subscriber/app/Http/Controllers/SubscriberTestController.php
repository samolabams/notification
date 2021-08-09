<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriberTestController extends Controller
{
    public function test1(Request $request)
    {
        $data = $request->post();

        Log::info('Message received', $data);

        return response()->json($data);
    }

    public function test2(Request $request)
    {
        $data = $request->post();

        Log::info('Message received', $data);

        return response()->json($data);
    }
}
