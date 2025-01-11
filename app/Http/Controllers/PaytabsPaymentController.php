<?php

namespace App\Http\Controllers;

use App\Http\Traits\OrderPaymentValidationTrait;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\TransactionWallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Paytabscom\Laravel_paytabs\Facades\paypage;


class PaytabsPaymentController extends Controller
{
    use OrderPaymentValidationTrait;

    public function createPayPage(Request $request)
    {
        $callbackUrl = route('paytabs.callback');
        $check = $this->makePaymentValidation($request);
        if (!$check['status']) {
            return sendError($check['message']);
        }
        $order = Order::query()->whereCanPayment()->find($request->order_id);
        if ($order) {
            $additionalData = 'ecom';
            $orderId = $order->id;
            $total = $order->total;
            //if order use a wallet check wallet have a balance


            $pay = paypage::sendPaymentCode('all')
                ->sendTransaction('sale', $additionalData) // Replace $additionalData with your actual data
                ->sendCart($orderId, $total, 'test')
                ->sendCustomerDetails('hakeem app', 'info@hakeem.com.sa', '0101111111', 'test', 'Nasr City', 'Cairo', 'EG', '1234', '100.279.20.10')
                ->sendShippingDetails('hakeem app', 'info@hakeem.com.sa', '0101111111', 'test', 'Nasr City', 'Cairo', 'EG', '1234', '100.279.20.10')
                ->sendHideShipping(true) //don't show this forms (Customer Details) & (Shipping Details)  in pay page
                ->sendURLs('', $callbackUrl)
                ->sendLanguage('en')
                ->create_pay_page();
            return $pay;
        } else {

            return sendError(trans('global.order_not_found_or_you_not_auth'));
        }
    }

    public function callback(Request $request)
    {
        if ($request['payment_result']['response_status'] == "A") {
            $order = Order::query()->whereCanPayment()->findOrFail($request['cart_id']);
            if ($order) {
                DB::beginTransaction();
                OrderPayment::query()->create([
                    'order_id' => $request['cart_id'],
                    'payment_reference' => $request['tran_ref'],
                    'status_transaction' => $request['payment_result']['response_status'] == "A" ? 'success' : 'failed',
                    'reference_no' => $request['payment_result']['response_code'],
                    'transaction_id' => $request['tran_ref'],
                    'category_payment' => $request['tran_type'],
                    'amount' => $request['cart_amount'],
                    'currency' => $request['tran_currency'],
                ]);
                $order->status = OrderStatus()['awaitingAccept'];
                $order->save();

                //if order use a wallet check wallet have a balance
                if ($order->use_wallet) {
                    $walletPatient = User::query()->find($order->owner_patient_id)->walletPatient;
                    if ($walletPatient->amount >= $order->wallet_deduction) {
                        $walletPatient->update(['amount' => $walletPatient->amount - $order->wallet_deduction]);
                       TransactionWallet::query()->create([
                            'wallet_id' => $walletPatient->id,
                            'currency' => $walletPatient->country->iso3,
                            'amount' => $order->wallet_deduction,
                            'description' => "will wallet deduction to complete order id $order->order_id",
                            'type' => '-',
                        ]);
                    } else {
                        //send to admin some order have error
                        //patient_wallet_balance_not_enough
                    }
                }


                DB::commit();
                return ['status' => true, 'msg' => trans('global.payment_successfully')];
            } else {
                return ['status' => false, 'msg' => trans('global.sorry_cant_pay_this_order')];
            }
        }
    }

}
