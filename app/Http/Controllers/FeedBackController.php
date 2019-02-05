<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedBackController extends Controller
{
    public function sendFeedback(Request $request) {

        $endpoint = "https://feedback-api.iotech.co.th/Send";
        $client = new \GuzzleHttp\Client();
        $data = [
            'msg' => $request->msg,
            'app_name' => 'edoc',
            'user' => auth()->user()->full_name
        ];
        $response = $client->request('POST', $endpoint, ['json' => $data]);

        // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        return response()->json([
            "status" => "success"
        ]);
    }
}
