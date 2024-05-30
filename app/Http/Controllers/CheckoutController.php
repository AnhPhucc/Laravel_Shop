<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {

        return view('checkout.index');
    }
    public function check(Request $request)
    {

        if ($request->value_payment = 'ttonl') {

            $this->payment_vnpay($request->total, $request->cart_id);
        }
        if ($request->value_payment = 'tttm') {

        }
    }

    public function payment_vnpay($total, $cart_id)
    {
        $randomCode = Str::random(11);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/cart";
        $vnp_TmnCode = "YCZO28RN"; //Mã website tại VNPAY 
        $vnp_HashSecret = "MGMMTU9AV34I877HK0K6VE3YCLIG11GD"; //Chuỗi bí mật

        $vnp_TxnRef = $randomCode; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn";
        $vnp_OrderType = "HTPHONE";
        $vnp_Amount = $total * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,

        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {

            header('Location: ' . $vnp_Url);
            $carts = Cart::where('user_id', \Auth::user()->id)->get();
            foreach ($carts as $cart) {
                $cart->delete();
            }
            die();

        } else {
            echo json_encode($returnData);

        }

    }

    public function process(Request $request)
    {

        return redirect()->route('confirmation')->with('success_message', 'Đơn hàng của bạn đã được đặt thành công!');
    }
}
