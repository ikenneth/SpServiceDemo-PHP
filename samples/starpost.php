<?php

/*
 * Created on 2015-04-24
 * Author Fury
 *
 */
header("Content-Type: text/html;charset=utf-8");
// Pull in the NuSOAP code
require_once('../lib/nusoap.php');
// Create the client instance
$client = new nusoap_client('http://112.74.88.204:9070/starpost-webservice/spservice?wsdl', true,'','','','');
$client->soap_defencoding = 'utf-8';
$client->decode_utf8 = false;
$client->xml_encoding = 'utf-8';
// Check for an error
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}
// Call the SOAP method


$data=<<<XML
<Request lang="zh-CN">
<Body>
   <Order 
       ref_number="11110002" 
	   express_code="MYXBP" 
	   buyer_id="ahmedasas" 
	   buyer_email="" 
	   insurance_sign="0" 
	   insurance_amount="0" 
	   goods_type="0" 
	   parcel_type="Gift" 
	   currency="" 
	   return_sign="0" 
	   remark="" 
	   operate_flag="2" 
	   d_company="" 
	   d_contact="Ahmed Asas" 
	   d_tel="13596323302" 
	   d_mobile="" 
	   d_email="" 
	   d_address="asas dairies" 
	   d_country="MY" 
	   d_province="iringa 255" 
	   d_city="iringa" 
	   d_post_code="92100" 
	   cargo_total_value="1" >
   <Cargo 
       oc_hscode="IP100005" 
	   oc_name_en="iphone5" 
	   oc_name_cn="iphone 5" 
	   oc_quantity="1" 
	   oc_sku="KU100005" 
	   oc_value="1" 
	   oc_weight="1" 
	   oc_remark="iPhone5"
	   />
   </Order>
</Body>
<Head>80010000</Head>
</Request>
XML;

$param=array("arg0" => $data,"arg1"=> base64_encode(strtoupper(md5($data.'47EC2DD791E31E2EF2076CAF64ED9B3D'))));

print_r("");
var_dump($param);

$result = $client->call('orderService', $param);
// Check for a fault
if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
        // Display the result
        echo '<h2>Result</h2><pre>';
        print_r($result);
        echo '</pre>';
    }
}
?>
