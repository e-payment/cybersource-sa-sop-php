<?php include 'security.php' ?>

<html>
<head>
    <title>Result</title>
    <link rel="stylesheet" type="text/css" href="../css/payment.css"/>
</head>
<body>
<img src="../img/logo-cybersource.png" style="padding-bottom: 10px;" />
<h2>SOP - Result</h2>

<hr/>
<div id="container">
<pre>
<?php

$response = $_REQUEST;
$amount   = @$response['auth_amount'];
if (!empty($amount)) {
	$amount .= ' ' . $response['req_currency'];
}

$message = 'ref_no: ' . $response['req_reference_number'];
echo $message . PHP_EOL;
echo 'amount: ' . $amount . PHP_EOL;

$message = 'status: ' . $response['decision'] . ' ' . $response['reason_code'] . ' - ' . $response['message'];
// lineNotify($message);

echo $message . PHP_EOL;

$params = array();
foreach($_POST as $name => $value) {
    $params[$name] = $value;
}

$signed = (strcmp($params["signature"], sign($params)) == 0 ? "true" : "false");
echo 'signature match: ' . $signed . "\n\n";

ksort($response);
print_r($response);

?>

</pre>
</div>

<hr/>
<p><a href="./">&lt;&lt; BACK</a></p>

</body>
</html>
