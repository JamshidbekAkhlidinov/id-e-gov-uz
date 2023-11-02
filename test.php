<pre>
    <?php


    use ustadev\IdEgovUz\IdEGovUzApi;

    include_once "vendor/autoload.php";

    $obj = new IdEGovUz("test", "test");

    $server_url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'];

    if (isset($_GET['code'])) {
        $code = $_GET['code'];

        $result = $obj->getAccessToken($code, $server_url);
        echo "access token api\n";
        print_r($result);

        $access_token = $result['access_token'] ?? '';
        $scope = $result['scope'] ?? '';
        if ($access_token && $scope) {
            echo "user data\n";
            print_r($obj->getUserData($access_token, $scope));
            print_r($obj->logout($access_token, $scope));
       }else{
            print_r("access token not found");
        }
    }
    ?>
</pre>
<h1>
    <a href="<?= $obj->getLoginUrl($server_url) ?>">
        Login for IdEGovUz
    </a>
</h1>
