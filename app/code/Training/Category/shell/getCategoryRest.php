<?php
$params = array('id' => null);
foreach ($argv as $arg) {
    if (preg_match("%^--(.*?)=(.*?)$%", $arg, $m)) {
        $params[$m[1]] = $m[2];
    }
}

if (!$params['id'])
    exit("Specify category_id (as --id=_ID_ parameter)\n");

$id   = (int)$params['id'];
$url  = 'http://127.0.0.1/magento2novi/index.php/rest/V1/categories/' . $id;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                     
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json'
            )
); 

curl_setopt($ch,CURLOPT_POSTFIELDS, $str);

$result = curl_exec($ch);
curl_close($ch);

$result = json_decode($result);
print_r($result);
