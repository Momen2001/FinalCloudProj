<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiAuthValidationTrait;
use App\Models\User;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\false;


class UpdatePhoneController extends Controller
{
    use ApiAuthValidationTrait;

    public function update_phone(Request $request)
    {
        try {
            $check = $this->update_phone_validation($request);
            if (!$check['status']) {
                return sendError($check['message'], [null]);
            }
            $auth_id = auth()->user()->id;
            $user = User::query()
                ->where('code', $request->code)
                ->find($auth_id);
            if (!$user) {
                return sendError(trans('auth.code_does_not_match'), [null]);
            }
            $check_phone_uses = User::query()
                ->userByPhone($request->phone, $request->intro)
                ->where('id', "=!", $auth_id)
                ->first();
            if ($check_phone_uses) {
                return sendError(trans('global.sorry_this_phone_is_uses'), [null]);
            }
            $user->update(['code' => null, 'phone' => $request->phone, 'intro' => $request->intro, 'trust_phone' => true]);
//            $user = \App\Models\User::query()->find($user->id);
//            $user = UserLoginResource::make($user);
            return sendResponse(null, trans('global.update_phone_success'));

        } catch (\Exception $exception) {
             return sendError(trans('global.some_error'), [null]);
        }
    }


}











