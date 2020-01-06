<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use TsaiYiHua\ECPay\Checkout;
use TsaiYiHua\ECPay\QueryInvoice;
use TsaiYiHua\ECPay\QueryTradeInfo;
use App\Http\Controllers\Controller;

class ECPayController extends Controller
{
    public function __construct(Checkout $checkout, QueryTradeInfo $queryTradeInfo, QueryInvoice $queryInvoice)
    {
        $this->checkout = $checkout;
        $this->queryTradeInfo = $queryTradeInfo;
        $this->queryInvoice = $queryInvoice;
    }

    public function sendOrder(Request $request)
    {
        $formData = [
            'UserId' => 123,
            'ItemDescription' => '產品描述',
            'ItemName' => '產品名稱001#產品名稱002#產品名稱003',
            'TotalAmount' => '2,550',
            'PaymentMethod' => 'Credit',
            // 'OrderResultURL' => '', // Client端回傳付款結果網址 待測試
            // 'TradeDesc'=> urlencode('測試訂單')
            // 'MerchantTradeDate'=> date('Y/M/D H:i:s'), // yyyy/MM/dd HH:mm:ss
        ];

        return $this->checkout->setPostData($formData)->send();

        /**
         * 信用卡 刷卡付款方式:分期付款、定期定額扣款
         */

        // 1.分期付款 withInstallment () 可以提供分期選項 ex:3,6,12
        // return $this->checkout->setPostData($formData)->withInstallment('3,6,12')->send();

        // 2.定期定額扣款 withPeriodAmount($periodAmt)
        // 每 2 個月扣 1 次 ，成功扣款 5 次後結束。每次扣款金額:103元(新台幣/NTD)
        // $periodAmt = [
        //     'PeriodAmount' => 2,550, // PeriodAmount 與 TotalAmount 須一致
        //     'PeriodType' => 'M',  // 何時扣 Y、M、D
        //     'Frequency' => '2',  // 多久一次
        //     'ExecTimes' => 5,   // 共扣幾次
        //     'PeriodReturnURL'
        // ];
        // return $this->checkout->setPostData($formData)->withPeriodAmount($periodAmt)->send();
    }

    /**
     * 查詢訂單 回傳json格式
     * @orderId : 訂單編號 MerchantTradeNo
     */
    public function queryInfo()
    {
        $orderId = 'O157828168559436459';   // 101元
        $orderId = 'O157827716678311645';  // 2550 元
        $orderId = 'hoyo2020002';  // 999 元 用其他api產生
        $orderId = 'O157829651197144734';  // 150 元 + 發票
        return $this->queryTradeInfo->getData($orderId)->query();
    }

    /**
     * 需要開立發票時 withInvoice()
     */
    public function sendOrderWithInvoice()
    {
        // 範例
        $items[0] = [
            'name' => '產品A',
            'qty' => '1',
            'unit' => '個',
            'price' => '150'
        ];
        $formData = [
            'ItemName'=>'產品A',
            'TotalAmount' => '150',
            'ItemDescription' => '產品簡介',
            'Items' => $items,
            'PaymentMethod' => 'Credit',
            'UserId' => 123,
        ];
        $invData = [
            'Items' => $items,
            'UserId' => 123,
            'CustomerName' => 'User Name',
            'CustomerAddr' => 'ABC 123',
            'CustomerEmail' => 'email@address.com',
            'CustomerPhone'=>'0900123456',
        ];
        return $this->checkout->setPostData($formData)->withInvoice($invData)->send();
    }

    /**
     * 查詢發票
     * @orderId : 訂單編號 MerchantTradeNo
     */
    public function queryInvInfo()
    {
        $orderId = 'O157829651197277433';
        return $this->queryInvoice->getData($orderId)->query();
    }
}
