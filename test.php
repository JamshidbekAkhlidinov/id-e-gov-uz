<?php

use ustadev\idegovuz\IdEGovUzApi;

include_once "vendor/autoload.php";

$api = new IdEGovUzApi(
    "client_id",
    "client_secret",
);

$server_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

?>

<h1>
    <a href="<?= $api->getLoginUrl($server_url) ?>">
        Login for IdEGovUz
    </a>
</h1>

<pre>
<?php
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $result = $api->getAccessToken($code, $server_url);
    echo "access token api\n";
    print_r($result);

    $access_token = $result['access_token'] ?? '';
    $scope = $result['scope'] ?? '';
    if ($access_token && $scope) {
        echo "user data\n";
        print_r($api->getUserData($access_token, $scope));
        //print_r($api->logout($access_token, $scope));
    } else {
        print_r("access token not found");
    }
}

?>
</pre>
