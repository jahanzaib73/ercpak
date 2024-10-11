<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class EasypaisaController extends Controller
{
    public function show()
    {
        return view('payments.Easypaisa.show');
    }

    public function DoCheckout(Request $request)
    {
        $data = $request->input();

        $amount = $data['price'];
        $amount = number_format($amount, 1);

        $DateTime = new \DateTime();
        $orderRefNum = $DateTime->format('YmdHis');

        $post_data =  array(
            "amount"              => $amount,
            "storeId"             => Config::get('constants.easypaisa.STORE_ID'),
            "postBackURL"         => Config::get('constants.easypaisa.POST_BACK_URL1'),
            "orderRefNum"         => $orderRefNum,
            "merchantHashedReq"   => "",                      // Optional
            "autoRedirect"        => "1",                     // Optional
            "paymentMethod"     => "MA_PAYMENT_METHOD",       // Optional
            "emailAddr"         => $data['email'],            // Optional
            "mobileNum"         => $data['number'],           // Optional
        );
        //OTC_PAYMENT_METHOD
        //MA_PAYMENT_METHOD
        //CC_PAYMENT_METHOD
        //QR_PAYMENT_METHOD

        $post_data['merchantHashedReq'] = $this->get_SecureHash($post_data);

        Session::put('post_data', $post_data);

        return view('payments.Easypaisa.doCheckout', compact('post_data'));
    }

    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
    private function get_SecureHash($data_array)
    {
        ksort($data_array);
        $str = '';
        $i = 1;

        foreach ($data_array as $key => $value) {
            if (!empty($value)) {
                if ($i == 1) {
                    $str = $key . '=' . $value;
                } else {
                    $str = $str . '&' . $key . '=' . $value;
                }
            }
            $i++;
        }

        // AES/ECB/PKCS5Padding algorithm
        $cipher = "aes-128-ecb";
        $crypttext = openssl_encrypt($str, $cipher, Config::get('constants.easypaisa.HASH_KEY'), OPENSSL_RAW_DATA);
        return Base64_encode($crypttext);
    }

    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
    public function checkoutConfirm(Request $request)
    {
        $response = $request->input();
        $post_data = array();
        $post_data['auth_token'] = $response['auth_token'];
        $post_data['postBackURL'] = Config::get('constants.easypaisa.POST_BACK_URL2');



        return view('payments.Easypaisa.checkoutConfirm', compact('post_data'));
    }
    //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
    public function paymentStatus(Request $request)
    {
        $response = $request->input();
        return view('payments.Easypaisa.paymentStatus', compact('response'));
    }
}
