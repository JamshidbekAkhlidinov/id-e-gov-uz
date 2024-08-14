<?php

namespace ustadev\idegovuz;

class UserData
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getSurName()
    {
        return $this->data['sur_name'] ?? "";
    }

    public function getPportNo()
    {
        return $this->data['pport_no'] ?? "";
    }

    public function getPin()
    {
        return $this->data['pin'] ?? "";
    }

    public function getUserId()
    {
        return $this->data['user_id'] ?? "";
    }

    public function getMidName()
    {
        return $this->data['mid_name'] ?? "";
    }

    public function getValid()
    {
        return $this->data['valid'] ?? "";
    }

    public function getUserType()
    {
        return $this->data['user_type'] ?? "";
    }

    public function getSessId()
    {
        return $this->data['sess_id'] ?? "";
    }

    public function getRetCd()
    {
        return $this->data['ret_cd'] ?? "";
    }

    public function getAuthMethod()
    {
        return $this->data['auth_method'] ?? "";
    }

    public function getPkcsLegalTin()
    {
        return $this->data['pkcs_legal_tin'] ?? "";
    }

    public function getFirstName()
    {
        return $this->data['first_name'] ?? "";
    }

    public function getFullName()
    {
        return $this->data['full_name'] ?? "";
    }
}