<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $data['lang'] = $request->lang;
        return view('admin.settings.index', $data);
    }

    public function saveSetting(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'local' => 'required|in:ar,en',
            'mobile' => 'digits:9|numeric',
            'email' => 'email',
        ]);

        if ($validator->fails()) {
            toastr()->error($validator->errors()->first());
            return redirect()->back();
        }

        $request_all = $request->except('_token', 'local');
        foreach ($request_all as $item => $data) {

            if ($data == null) {
                toastr()->error('العنصر ( ' . "$item" . ' ) مطلوب. يرجى التأكد من صحة البيانات  ');
                return redirect()->route('admin.settings.index');
            }

            $setting_row = Setting::query()->where('key', "$item")
                ->first();

            if (in_array($item, ['patient_home_note', 'terms', 'policy', 'address', 'payment_and_refund_policy'])) {
                $setting_row->update([
                    "$request->local" => [
                        'value' => $data,
                    ]]);
            } else {
                $setting_row->update([
                    "ar" => [
                        'value' => $data,
                    ],
                    "en" => [
                        'value' => $data,
                    ],
                ]);
            }
        }
        toastr()->success(trans('cruds.setting.settings_save_successfully'));
        return redirect()->route('admin.settings.index', ['lang' => $request->local]);
    }
}
