<?php

namespace Structuremedia\Versio\Modules;

use Illuminate\Support\Arr;
use Structuremedia\Versio\Exception\Exception;
use Structuremedia\Versio\Exception\ErrorMsg;

class Contact extends BaseModule
{
    protected $arrayKey = 'ContactList';
    protected $urlPrefix = "contacts";

    public function get($contactId)
    {
        $info = $this->call("GET",$this->urlPrefix . '/' . $contactId);
        return Arr::get($info, "contactInfo");
    }

    public function list()
    {
        $info = $this->call("GET",$this->urlPrefix);
        return Arr::get($info, "ContactList");
    }

    public function resendValidation($contactId)
    {
        $info = $this->call("POST",$this->urlPrefix . '/' . $contactId . '/resendvalidation');
        return $info;
    }

    public function delete($contactId)
    {
        $info = $this->call("DELETE",$this->urlPrefix . '/' . $contactId);
        return $info;
    }

    public function create($contactDetails, $default = false)
    {
        if($default)
        {
            $contactDetails["default"] = $true;
        }

        $info = $this->call("POST",$this->urlPrefix, $contactDetails);
        return $info;
    }

}