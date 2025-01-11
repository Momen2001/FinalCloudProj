<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\RegisterRequest;
use App\Http\Traits\ApiAuthValidationTrait;
use App\Jobs\SendTaqnyatSms;
use App\Models\User;
use App\Models\WalletPatient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Webmozart\Assert\Tests\StaticAnalysis\false;


class RegisterController extends Controller
{
    use ApiAuthValidationTrait;

    public function register(RegisterRequest $request)
    {
        try {
             $code = rand(1111, 9999);
            DB::beginTransaction();

            $fcm_notification = ($request->hasHeader('fcm_notification')) ? $request->header('fcm_notification') : null;
            $platform = ($request->hasHeader('platform')) ? $request->header('platform') : 'en';
            if (!$platform) {
                return response()->json(['status' => true, 'msg' => trans('auth.platform_required')]);

            }

            /********   delete zero from phone number  ****/
            $phone = ltrim($request->phone, '0');
            /********   delete zero from phone number  ****/

            $checkPhone = User::query()->userByPhone($phone, $request->intro)->exists();
            if ($checkPhone) {
                return response()->json(['status' => true, 'msg' => trans('auth.sorry_this_phone_is_already_in_use')]);

            }

            $user = \App\Models\User::query()->create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => Carbon::parse($request->birth_date)->locale('en')->format('Y-m-d'),
                'country_id' => $request->country_id,
                'passport_id' => $request->passport_id,
                'phone' => $phone,
                'intro' => $request->intro,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'confirm_condition' => $request->confirm_condition,
                'fcm_notification' => $fcm_notification,
                'gender' => $request->gender,
                'code' => $code,
                'role_id' => 3, //Patient
                'platform' => $platform,
            ]);

            $user = User::query()->findOrFail($user->id);
            WalletPatient::query()->create([
                'patient_id' => $user->id,
                'amount' => 0,
            ]);
            $msg = trans('global.register_msg_send_code', ['code' => $code]);
            $fullPhone = $request->intro . $phone;
            dispatch(new SendTaqnyatSms($msg, $fullPhone));

            DB::commit();
            return response()->json(['status' => true, 'msg' => trans('auth.send_code_success')]);

        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['status' => true, 'msg' => trans('global.some_error')]);
        }
    }

    public function check_code(Request $request)
    {
        try {
            $check = $this->check_code_validation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }

            $user = \App\Models\User::query()
                ->userByPhone($request->phone, $request->intro)
                ->where('code', $request->code)
                ->first();

            if (!$user) {
                return sendError(trans('auth.code_does_not_match'), [null]);
            }
            $user->update(['code' => null, 'trust_phone' => true]);
            $user = \App\Models\User::query()->find($user->id);
            $user = UserLoginResource::make($user);
            return sendResponse($user, trans('auth.login_success'));

        } catch (\Exception $exception) {
            return sendError(trans('global.some_error'), [null]);
        }
    }

    public function resendCode(Request $request)
    {
        try {
            $check = $this->resendCodeValidation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }
            $code = rand(1111, 9999);
            $msg = trans('global.register_msg_resend_code', ['code' => $code]);

            $fullPhone = $request->intro . $request->phone;
            dispatch(new SendTaqnyatSms($msg, $fullPhone));

            if (auth('api')->check()) {
                User::query()->find(auth('api')->user()->id)->update(['code' => $code]);
                return sendResponse([], trans('auth.resend_code_successfully'));

            } else {
                $user = \App\Models\User::query()->UserByPhone($request->phone, $request->intro)->first();
                if ($user) {

                    $user->update(['code' => $code]);
                    $user = \App\Models\User::query()->find($user->id);
                    $user = ShowUserResource::make($user);
                    //send sms
                    return sendResponse([], trans('auth.resend_code_successfully'));
                } else {
                    return sendError(trans('auth.not_found_this_phone'), [null]);
                }
            }

        } catch (\Exception $exception) {
            //return $exception;
            return sendError(trans('global.some_error'), [null]);
        }
    }


    public function resetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // update password
            $check = $this->resetPasswordValidation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }
            $auth = auth()->user();
            \App\Models\User::query()->find($auth->id)->update(['password' => bcrypt($request->password)]);
            $user = \App\Models\User::query()->find($auth->id);
            $user = UserLoginResource::make($user);
//            //send sms
            return sendResponse([], trans('auth.resetPasswordSuccessfully'));
        } catch (\Exception $exception) {
            return sendError(trans('global.some_error'), [null]);
        }
    }


    public function forgetPassword(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $check = $this->forgetPasswordValidation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }
            $user = \App\Models\User::query()->UserByPhone($request->phone, $request->intro)
                ->where('code', null)->first();

            if ($user) {
                $code = rand(1111, 9999);

                if (auth('api')->check()) {
                    User::query()->find(auth('api')->user()->id)->update(['code' => $code]);
                } else {
                    $user = \App\Models\User::query()->UserByPhone($request->phone, $request->intro)->first();
                    if ($user) {
                        $user->update(['code' => $code]);
                    }
                }

                $msg = trans('global.register_msg_forget_password', ['code' => $code]);
                $fullPhone = $request->intro . $request->phone;
                dispatch(new SendTaqnyatSms($msg, $fullPhone));

                $user->update(['password' => bcrypt($request->password)]);
                return sendResponse([], trans('auth.resetPasswordSuccessfully'));
            } else {
                return sendError(trans('auth.sorry_information_user_not_correct'), [null]);
            }

        } catch (\Exception $exception) {
            return sendError(trans('global.some_error'), [null]);
        }
    }

    public function check_code_forget_password(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $check = $this->check_code_validation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }

            $user = \App\Models\User::query()
                ->userByPhone($request->phone, $request->intro)
                ->where('code', $request->code)
                ->first();

            if (!$user) {
                return sendError(trans('auth.code_does_not_match'), [null]);
            }
            $user->update(['code' => null]);
            return sendResponse([], trans('auth.check_successfully'));

        } catch (\Exception $exception) {
            return sendError(trans('global.some_error'), [null]);
        }
    }


}











