<?php

namespace ustadev\IdEGovUz;

class IdEGovUz
{
    public $client_id = "";
    public $client_secret = "";
    public $scope = 'scope';

    private const auth_url = "https://sso.egov.uz/sso/oauth/Authorization.do";
    private $method = 'get';
    private $response_type = 'one_code';

    public function __construct($client_id, $client_secret)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    public function getLoginUrl($redirect_url)
    {
        $params = [
            'response_type' => $this->response_type,
            'client_id' => $this->client_id,
            'redirect_uri' => $redirect_url,
            'scope' => $this->scope,
            'state' => $this->client_id
        ];
        return self::auth_url . "?" . http_build_query($params);
    }

    public function getAccessToken($code, $redirect_uri)
    {
        $this->method = 'post';
        return $this->request([
            'grant_type' => 'one_authorization_code',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $redirect_uri,
            'code' => $code,
        ]);
    }

    public function getUserData($access_token, $scope)
    {
        $this->method = 'post';
        return $this->request([
            'grant_type' => 'one_access_token_identify',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'access_token' => $access_token,
            'scope' => $scope,
        ]);
    }

    public function logout($access_token, $scope)
    {
        $this->method = 'post';
        return $this->request([
            'grant_type' => 'one_log_out',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'access_token' => $access_token,
            'scope' => $scope,
        ]);
    }

    private function request($params = []): array
    {
        $ch = curl_init();
        $url = self::auth_url;
        if ($this->method == 'get') {
            $url .= "?" . http_build_query($params);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        if ($this->method == 'post') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        return json_decode(curl_exec($ch), true);
    }
}