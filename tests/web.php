<?php
use Entere\Alipay\Web;
include '../src/Web/SdkPayment.php';
class webtest{
	public function pay() {
		$alipay = new Entere\Alipay\Web\SdkPayment();
		// 创建支付单。
		$alipay
			->setPartner('2088801376402861')
			->setKey('m353qzojicdpyzgnjj0gxrsfgm481n7l')
			->setSellerId('mall@blogchina.com')
			->setReturnUrl('http://localhost/github/alipay/tests/web.php')
			->setOutTradeNo(time())
			->setTotalFee(0.01)
			->setSubject('goods_name')
			->setBody('goods_description');

		// 跳转到支付页面。
		echo "<a href='".$alipay->getPayLink()."'>click</a>";
	}


	public function webReturn(){
		$alipay = new Entere\Alipay\Web\SdkPayment();
		// 创建支付单。
		$alipay
			->setPartner('2088801376402861')
			->setKey('m353qzojicdpyzgnjj0gxrsfgm481n7l')
			->setSellerId('mall@blogchina.com');
			

		// 验证请求。
        if (! $alipay->verify()) {
        	echo 'verify fail';
            return false;
        }

        // 判断通知类型。
        switch ($_GET['trade_status']) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                print_r($_GET);
                break;
        }

        return true;
	}
}

$webtest = new webtest();
$webtest->pay();
$webtest->webReturn();