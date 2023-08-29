<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendSms()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'api_key' => 'gsn32LmNJ57EYTfE371C68M64An69DiJRGIIcL81',
            'msg' => 'Order successfully completed',
            'to' => '8801868332991'
        ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return "Success";

    }

    public function sendOrderConfirmationEmail($user, $order, $orderItem)
    {
        // dd($user);
        Mail::to($user->email)->send(new OrderConfirmation($user, $order, $orderItem));
    }

    // image upload
    public function imageUpload($request, $name, $directory)
    {
        $doUpload = function ($image) use ($directory) {
            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extention = $image->getClientOriginalExtension();
            $imageName = $name . '_' . uniqId() . '.' . $extention;
            $image->move($directory, $imageName);
            return $directory . '/' . $imageName;
        };

        if (!empty($name) && $request->hasFile($name)) {
            $file = $request->file($name);
            if (is_array($file) && count($file)) {
                $imagesPath = [];
                foreach ($file as $key => $image) {
                    $imagesPath[] = $doUpload($image);
                }
                return $imagesPath;
            } else {
                return $doUpload($file);
            }
        }

        return false;
    }

    public function generateCode($model, $prefix = '')
    {
        $code = "000001";
        $model = '\\App\\Models\\' . $model;
        $num_rows = $model::count();
        if ($num_rows != 0) {
            $newCode = $num_rows + 1;
            $zeros = ['0', '00', '000', '0000'];
            $code = strlen($newCode) > count($zeros) ? $newCode : $zeros[count($zeros) - strlen($newCode)] . $newCode;
        }
        return $prefix . $code;
    }

}