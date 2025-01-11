<?php

namespace App\Http\Controllers;

use App\Http\Traits\OrderPaymentValidationTrait;
use App\Http\Traits\PaymentTrait;
use App\Models\Order;
use App\Models\OrderPayment;
use CodeBugLab\NoonPayment\NoonPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoonPaymentController extends Controller
{
    use OrderPaymentValidationTrait;


    public function index(Request $request)
    {

//        http://localhost:8000/noon_payment?order_id=4

        $check = $this->makePaymentValidation($request);
        if (!$check['status']) {
            return sendError($check['message']);
        }
        $order = Order::query()->whereCanPayment()->findOrFail($request->order_id);
//        $check_auth = auth('api')->check();
//        if ($order && $check_auth) {
        if ($order) {
            $response = NoonPayment::getInstance()->initiate([
                "order" => [
                    "reference" => $order->id,
                    "amount" => $order->total,
                    "currency" => "SAR",
                    "name" => "Sample order name",
                ],
                "configuration" => [
                    "locale" => "en"
                ],
//
                // refund transaction you cant use pot man collection
//                "apiOperation" => "REFUND",
//                "order" => [
//                    "Id" => "141475932337"
//                ],
//                "transaction" => [
//                    "amount" => "20",
//                    "currency" => "SAR",
//                    "targetTransactionId" => "Reference of the captured txn to refund"
//                ]
            ]);

            if ($response->resultCode == 0) {
                return redirect($response->result->checkoutData->postUrl);
            }
            return $response->message;
        } else {
            return sendError(trans('global.order_not_found_or_you_not_auth'));
        }

    }

//    public function response(Request $request)
//    {
//
//        try {
//
//            $response = NoonPayment::getInstance()->getOrder($request->orderId);
//            if ($this->isSaleTransactionSuccess($response)) {
//                //success
//                return "Transaction Success";
//                $order = Order::query()->whereCanPayment()->findOrFail($request->merchantReference);
//                if ($order) {
//                    DB::beginTransaction();
//                    OrderPayment::query()->create([
//                        'order_id' => $request->merchantReference,
//                        'payment_reference' => $response->result->order->id,
//                        'status_transaction' => $response->result->order->status,
//                        'reference_no' => $response->result->order->reference,
//                        'transaction_id' => $response->result->order->id,
//                        'category_payment' => $response->result->order->category,
//                        'amount' => $response->result->order->amount,
//                        'currency' => $response->result->order->currency,
//                        'use_wallet' => 0,
//                    ]);
//                    $order->status = OrderStatus()['awaitingImplementation'];
//                    $order->save();
//                    DB::commit();
//                    return sendResponse([$order, 'order_status' => $response->result->order->status], trans('global.payment_successfully'));
//                } else {
//                    return sendError(trans('global.sorry_cant_pay_this_order'),);
//                }
//            }
//
//            // cancel
//            // return ['status' => true, 'msg' => trans('global.payment_failure')];
//
//        } catch (\Exception $exception) {
//            DB::rollBack();
//        }
//
//    }


    public function response(Request $request)
    {
        try {
            $response = NoonPayment::getInstance()->getOrder($request->orderId);

            if ($this->isSaleTransactionSuccess($response)) {
                // return "Transaction Success";

                // cancel
                $order = Order::query()->whereCanPayment()->findOrFail($request->merchantReference);
                if ($order) {
                    DB::beginTransaction();
                    OrderPayment::query()->create([
                        'order_id' => $request->merchantReference,
                        'payment_reference' => $response->result->order->id,
                        'status_transaction' => $response->result->order->status,
                        'reference_no' => $response->result->order->reference,
                        'transaction_id' => $response->result->order->id,
                        'category_payment' => $response->result->order->category,
                        'amount' => $response->result->order->amount,
                        'currency' => $response->result->order->currency,
                    ]);
                    $order->status = OrderStatus()['awaitingImplementation'];
                    $order->save();
                    DB::commit();
                    return ['status' => true, 'msg' => trans('global.payment_successfully')];
                } else {
                    return ['status' => false, 'msg' => trans('global.sorry_cant_pay_this_order')];
                }
            }
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }


    private function isSaleTransactionSuccess($response)
    {
        return isset($response->result->transactions) &&
            is_array($response->result->transactions) &&
            $response->result->transactions[0]->type == "SALE" &&
            $response->result->transactions[0]->status == "SUCCESS";
    }
}
