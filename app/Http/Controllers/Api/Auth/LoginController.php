<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserLoginResource;
use App\Http\Traits\ApiAuthValidationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    use ApiAuthValidationTrait;

    public function loginPatient(Request $request)
    {
        try {
            $check = $this->login_validation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }

            $user = \App\Models\User::query()->wherePatient();
            if (is_numeric($request->get('emailOrPhone'))) {
                $check = $this->login_validation_phone($request);
                if ($check['status'] == "errorInEmailOrPhone") {
                    return sendError($check['message'], [null]);
                } elseif ($check['status'] == "SuccessAuth") {
                    $user = $user->UserByPhone($request->emailOrPhone, $request->intro)->first();
                    if (!$user) {
                        return sendError(trans('auth.failed'), [null]);
                    }

                    if (Hash::check($request->password, $user->password)) {
                        if ($user->trust_phone == 0) {
                            return sendErrorNotVerify(trans('auth.your_account_not_verified'), [null]);
                        }
                        $user = UserLoginResource::make($user);
                        return sendResponse($user, trans('auth.login_success'));
                    } else {
                        return sendError(trans('auth.failed'), [null]);
                    }
                }

            } else {

                $check = $this->login_validation_email($request);
                if ($check['status'] == "errorInEmailOrPhone") {
                    return sendError($check['message'], [null]);
                } elseif ($check['status'] == "SuccessAuth") {
                    $user = $user->UserByEmail($request->emailOrPhone)->first();
                    if (Hash::check($request->password, $user->password)) {
                        if ($user->trust_phone == 0) {
                            return sendErrorNotVerify(trans('auth.your_account_not_verified'), [null]);
                        }
                        $user = UserLoginResource::make($user);
                        return sendResponse($user, trans('auth.login_success'));
                    } else {
                        return sendError(trans('auth.failed'), [null]);
                    }
                }
            }
        } catch (\Exception $exception) {
            return sendError(trans('global.some_error'), [null]);
        }
    }


    public function loginDoctor(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $check = $this->login_validation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }

            $user = \App\Models\User::query()->whereDoctor();

            if (is_numeric($request->get('emailOrPhone'))) {
                $check = $this->login_validation_phone($request);
                if ($check['status'] == "errorInEmailOrPhone") {
                    return sendError($check['message'], [null]);

                } elseif ($check['status'] == "SuccessAuth") {
                    $user = $user->UserByPhone($request->emailOrPhone, $request->intro)->first();

                    if (!$user) {
                        return sendError(trans('auth.failed'), [null]);
                    }

                    if (Hash::check($request->password, $user->password)) {
                        if ($user->trust_phone == 0) {
                            return sendErrorNotVerify(trans('auth.your_account_not_verified'), [null]);
                        }

                        $user = UserLoginResource::make($user);
                        return sendResponse($user, trans('auth.login_success'));
                    } else {
                        return sendError(trans('auth.failed'), [null]);
                    }
                }

            } else {
                $check = $this->login_validation_email($request);
                if ($check['status'] == "errorInEmailOrPhone") {
                    return sendError($check['message'], [null]);
                } elseif ($check['status'] == "SuccessAuth") {
                    $user = $user->UserByEmail($request->emailOrPhone)->first();
                    if (Hash::check($request->password, $user->password)) {
                        if ($user->trust_phone == 0) {
                            return sendErrorNotVerify(trans('auth.your_account_not_verified'), [null]);
                        }
                        $user = UserLoginResource::make($user);
                        return sendResponse($user, trans('auth.login_success'));
                    } else {
                        return sendError(trans('auth.failed'), [null]);
                    }
                }
            }

        } catch (\Exception $exception) {
            return sendError(trans('global.some_error'), [null]);
        }
    }


    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return sendResponse([], trans('auth.logout_success'));

        } else {
            return sendError(trans('global.some_error'), [null]);
        }
    }

}
