<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LineController extends Controller
{
    //
    private $line = array();
    function __construct() {
        $this->line['client_id'] = env('LINE_CLIENT_ID');
        $this->line['secret'] = env('LINE_SECRET');
    }

    public function callback(Request $request)  {
        $request_token = json_decode($this->get_token($request->code));
        if($request_token->access_token !== null) {
            Line::updateOrCreate(
                ['uid' => Auth::id()],
                ['line_token' => $request_token->access_token]
            );
        }
        return redirect('/index')
        ->withSuccess('ทำรายการสำเร็จ');
    }

    public function testSend(Request $request) {
        $user = User::where('id',$request->user)->first();
        $send = $this->sendNotify($user, 'test message');
        return $send;
    }

    public function Send(Request $request, $message) {
        $user = User::where('id',$request->user)->first();
        $send = $this->sendNotify($user, $message);
        return $send;
    }

    public function sendNotify(User $user, $message) {
        $user_token = Line::where('uid',$user->id)->first();
        if($user_token->line_token == '') {
            return response()->json(['status'=>'error', 'message'=>'Current user does not connect with LINE Notify service.'], 400);
        } else {
            $data = [
                'message'=>$message
            ];
            $curl = curl_init('https://notify-api.line.me/api/notify');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$user_token->line_token,
                                                        'Content-Type: application/x-www-form-urlencoded'));
            $response = curl_exec($curl);
            echo $response;
            curl_close($curl);
            return response()->json(['status'=>'success', 'message'=>$message], 200);
        }
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        echo 'line';
    }

    public function unset()
    {
        Line::where('uid', Auth::id())->delete();

        return redirect()->back()
            ->withSuccess('ทำรายการสำเร็จ');
    }

    private function get_token($code) {

        $data = [
                'grant_type'=>'authorization_code',
                'code'=>$code,
                'redirect_uri'=>url('line_callback'),
                'client_id'=>$this->line['client_id'],
                'client_secret'=>$this->line['secret']
            ];
        $curl = curl_init('https://notify-bot.line.me/oauth/token');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
}
