<?php

namespace App\Services;


use App\Jobs\SendTaqnyatSms;
use GuzzleHttp\Client;
use function Webmozart\Assert\Tests\StaticAnalysis\true;


class TaqnyatSms
{
    public static function NotificationOrder($order, $msg)
    {
        dispatch(new SendTaqnyatSms($msg, $order->ownerPatient->getFullPhone()));
        if ($order->hospital_id) {
            dispatch(new SendTaqnyatSms($msg, $order->hospital->getFullPhone()));
        } elseif($order->doctor) {
            dispatch(new SendTaqnyatSms($msg, $order->doctor->getFullPhone()));
            dispatch(new SendTaqnyatSms($msg, $order->doctor->doctorSetting->hospital->getFullPhone()));
        }
    }

    /*** Feedback : use https://dev.taqnyat.sa/ar/doc/sms/#message-send-resource **/

    public static function sendMessage($msg, $phone)
    {
        $client = new Client();
        $res = $client->request('POST', 'https://api.taqnyat.sa/v1/messages?', [
            'form_params' => [
                'bearerTokens' => config('Sms.bearerTokens'),
                'sender' => config('Sms.sender'),
                'recipients' => '00' . $phone, //can sed array or number example 966500000000,966500000000
                'body' => $msg,
            ]
        ]);
        $statusCode = $res->getStatusCode();
        if ($statusCode == 201) {
            return ['status' => true, 'msg' => trans('global.send_code_successfully')];
        } else {
            return ['status' => false, 'msg' => trans('global.send_code_failure')];
        }

//        echo $res->getHeader('content-type');
//        echo $res->getBody();
    }

}









