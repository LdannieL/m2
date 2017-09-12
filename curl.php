<?php

$adminUrl='http://127.0.0.1/magento2novi/index.php/rest/V1/integration/admin/token';
$ch = curl_init();
$data = array("username" => "admin", "password" => "admin123");
$data_string = json_encode($data);
$ch = curl_init($adminUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($data_string))
);
$token = curl_exec($ch);
$token= json_decode($token);
//echo $token;
//Use above token into header
$headers = array("Authorization: Bearer $token");

//$requestUrl='http://127.0.0.1/magento2novi/index.php/rest/V1/customers/1';
$requestUrl='http://127.0.0.1/magento2novi/index.php/rest/V1/products/24-MB01';  //24-MB01 (WJ01)  is sku 24-MB01

$ch = curl_init();
$ch = curl_init($requestUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result);
print_r($result);