<?php

include_once('report_config.php');
ob_start();

//create array of data to be posted
$post_data['type']                    = 'transaction';
$post_data['subtype']                 = 'transactionDetail';
$post_data['targetDate']              = '20180619';
$post_data['merchantReferenceNumber'] = 'BAY2018061901';
// $post_data['requestID'               = '';

//-----------------------------------------------------------------------------

//traverse array and prepare data for posting (key1=value1)
foreach ($post_data as $key => $value) {
	$post_items[] = $key . '=' . $value;
}

//create the final string to be posted using implode()
$post_string = implode('&', $post_items);

//create cURL connection
$curl_conn = curl_init(REPORT_ENDPOINT);

//set options
if (PROXY_ENABLE) {
	// proxy configuration
	curl_setopt($curl_conn, CURLOPT_PROXY, PROXY_HOST . ':' . PROXY_PORT);

	if (PROXY_AUTHEN) {
		curl_setopt($curl_conn, CURLOPT_PROXYUSERPWD, PROXY_USER . ':' . PROXY_PASS);
	}
}

// user authentication
curl_setopt($curl_conn, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl_conn, CURLOPT_USERPWD, RPT_USERNAME . ":" . RPT_PASSWORD);

// curl_setopt($curl_conn, CURLOPT_HEADER, true);
curl_setopt($curl_conn, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_conn, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_conn, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($curl_conn, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_conn, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
// curl_setopt($curl_conn, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");

//set data to be posted
curl_setopt($curl_conn, CURLOPT_POSTFIELDS, $post_string);

//perform our request
$result = curl_exec($curl_conn);

//show information regarding the request
$status = curl_getinfo($curl_conn);

ob_end_clean();
header("Content-Type: application/json");

if ($status['http_code'] !== 200) {
	echo json_encode($status, JSON_PRETTY_PRINT) . PHP_EOL;
	// $res_status = gmdate('Y-m-d H:i:s', time() + 7 * 3600) . '  http_code: ' . $status['http_code'];
	exit(0);
}

// echo PHP_EOL . '=====================================';
// echo PHP_EOL . ' ' . $res_status;
// echo PHP_EOL . '=====================================' . PHP_EOL;

$result = preg_replace('~\s*(<([^-->]*)>[^<]*<!--\2-->|<[^>]*>)\s*~','$1', $result);
// Convert CDATA into xml nodes.
$result = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
// Return JSON.
echo json_encode($result, JSON_PRETTY_PRINT) . PHP_EOL;

//header("Content-Type: application/xml");
//print_r($result);

// echo curl_errno($curl_conn) . '-' . curl_error($curl_conn);

//close the connection
curl_close($curl_conn);

// logging result
//file_put_contents('./query_result.txt', $res_status . PHP_EOL, FILE_APPEND);


// EOF