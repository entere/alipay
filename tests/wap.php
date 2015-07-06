<?php
use Entere\Alipay\Wap;
include '../src/Wap/SdkPayment.php';
class waptest{
	public function pay() {
		$alipay = new Entere\Alipay\Wap\SdkPayment();
		// 创建支付单。
		$alipay
			->setPartner('***')
			->setSignType('RSA')
			->setItBPay('48h')
			->setExternToken('')
			->setPrivateKeyPath('../key/rsa_private_key.pem')
			->setPublicKeyPath('../key/rsa_public_key.pem')
			->setAliPublicKeyPath('../key/alipay_public_key.pem')
			->setSellerId('mall@blogchina.com')
			->setReturnUrl('http://localhost/github/alipay/tests/wap.php')
			->setNotifyUrl('http://localhost/github/alipay/tests/wap.php')
			->setOutTradeNo(time())
			->setTotalFee(0.01)
			->setSubject('goods_name')
			->setBody('goods_description');

		// 跳转到支付页面。
		echo "<a href='".$alipay->getPayLink()."'>click</a>";
	}


	public function wapReturn(){
		$alipay = new Entere\Alipay\Wap\SdkPayment();
		// 创建支付单。
		$alipay
			->setPartner('2088801376402861')
			->setSignType('RSA')
			->setItBPay('48h')
			->setPrivateKeyPath('../key/rsa_private_key.pem')
			->setPublicKeyPath('../key/rsa_public_key.pem')
			->setAliPublicKeyPath('../key/alipay_public_key.pem')
			->setSellerId('mall@blogchina.com')
			->setReturnUrl('http://localhost/github/alipay/tests/wap.php')
			->setNotifyUrl('http://localhost/github/alipay/tests/wap.php');

			

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

$waptest = new waptest();
$waptest->pay();
$waptest->wapReturn();