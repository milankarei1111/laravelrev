<?php

namespace App\Http\Controllers\Backend;

use TsaiYiHua\ECPay\ECPay;
use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use App\Http\Controllers\Controller;

class ECPayController extends Controller
{
    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function index()
    {
        return view('backend.order.index');
    }

    public function sendOrder(Request $request)
    {

        $formData = [
            'UserId' => 123,
            'ItemDescription' => '產品描述',
            'ItemName' => '產品名稱001#產品名稱002#產品名稱003',
            'TotalAmount' => '2550',
            'PaymentMethod' => 'ATM',
            // 'MerchantTradeNo ' => 1234567891234567890,
            // 'TradeDesc'=> urlencode('測試訂單')
            // 'MerchantTradeDate'=> date('Y/M/D H:i:s'), // yyyy/MM/dd HH:mm:ss
        ];
        return $this->checkout->setPostData($formData)->send();


        /**
         * 信用卡 刷卡方式 Credit:分期付款、定期定額扣款
         */
        // 每 2 個月扣 1 次 ，成功扣款 5 次後結束。每次扣款金額:2,550元(新台幣/NTD)
        $periodAmt = [
            'PeriodAmount' => 2550, // PeriodAmount與TotalAmount 須一致
            'PeriodType' => 'M',  // 何時扣 Y、M、D
            'Frequency' => '2',  // 多久一次
            'ExecTimes' => 5,   // 共扣幾次
            'PeriodReturnURL'
        ];

        // 分期付款 withInstallment () 可以提供分期選項 ex:3,6,12
        // return $this->checkout->setPostData($formData)->withInstallment('3,6,12')->send();

        // 定期定額扣款 withPeriodAmount($periodAmt)
        // return $this->checkout->setPostData($formData)->withPeriodAmount($periodAmt)->send();
    }
}
