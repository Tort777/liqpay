<?php

require_once("config.php");

$liqpay_url="https://www.liqpay.com/?do=clickNbuy";

if (!isset($_REQUEST['x_invoice_num']) || !isset($_REQUEST['x_amount']))
{
 echo "<meta http-equiv='refresh' content='0; URL=$failure_url>";
 exit;
}

$order_id = $_REQUEST['x_invoice_num'];
$amount = $_REQUEST['x_amount'];

    $xml = "<request>      
		<version>1.2</version>
		<result_url>$callback_url</result_url>
    <server_url>$callback_url</server_url>
		<merchant_id>$liqpay_merchant_id</merchant_id>
		<order_id>$order_id</order_id>
		<amount>$amount</amount>
		<currency>$liqpay_currency</currency>
		<description>Dog-Nannies.com.ua</description>
		<default_phone>$liqpay_phone</default_phone>
		<pay_way>$liqpay_method</pay_way> 
		</request>
		";
	
	$xml_encoded = base64_encode($xml); 
	$lqsignature = base64_encode(sha1($liqpay_signature.$xml.$liqpay_signature,1));

echo("<form action='$liqpay_url' method='POST'>
      <input type='hidden' name='operation_xml' value='$xml_encoded' />
      <input type='hidden' name='signature' value='$lqsignature' />
	<input type='submit' value='Pay'/>
	</form>");

?>