<?php

namespace Structuremedia\Versio\Modules;

use Illuminate\Support\Arr;
use Structuremedia\Versio\Exception\Exception;
use Structuremedia\Versio\Exception\ErrorMsg;

class Domain extends BaseModule
{
    protected $arrayKey = 'domainInfo';
    protected $urlPrefix = "domains";
    protected $domainStates = ["OK", "PENDING_TRANSFER", "INACTIVE", "EXPIRED", "PENDING", "TRANSFERRED_OUT"];

    public function checkAvailability($domain)
    {
        $info = $this->call("GET", $this->urlPrefix . '/' . $domain . '/availability');
        return $info;
    }

    public function get($domain, $showDnsRecords = true)
    {

        if($showDnsRecords)
        {
            $domain = $domain.'?show_dns_records=true';
        }

        $info = $this->call("GET",$this->urlPrefix . '/' . $domain);

        return Arr::get($info, $this->arrayKey);
    }

    public function list($status = "*")
    {

        if($status == "*")
        {
            $status = "";
        } else {
            if(!in_array(mb_strtoupper($status), $this->domainStates)){
                throw new Exception(ErrorMsg::INVALID_DOMAIN_STATE_FILTER);
            }
            $status = '?status='.mb_strtoupper($status);
        }

        $info = $this->call("GET", $this->urlPrefix.$status);

        return Arr::get($info, 'DomainsList');
    }

    public function transferStatus($domain, $processId)
    {
        $info = $this->call("GET", $this->urlPrefix . '/' . $domain . '/transfer/' . $processId);
        return $info;
    }

    public function delete($domain)
    {
        $info = $this->call("DELETE", $this->urlPrefix . '/' . $domain);
        return $info;
    }

    public function register($domain, $contactId, $years, $ns = null, $autoRenew = false, $idnLocale = null)
    {

        $postData = [
            "contact_id" => $contactId,
            "years" => $years,
            "auto_renew" => $autoRenew,
            "idn_locale" => $idnLocale,
            "ns" => $ns,
        ];

        $info = $this->call("POST", $this->urlPrefix . '/' . $domain, $postData);
        return $info;
    }

    public function renew($domain, $years)
    {
        $info = $this->call("POST", $this->urlPrefix . '/' . $domain . '/renew', ["years" => $years]);
        return $info;
    }

    public function transferIn($domain, $contactId, $years, $authCode, $autoRenew = false, $ns = null)
    {

        $postData = [
            "contact_id" => $contactId,
            "years" => $years,
            "auth_code" => $authCode,
            "auto_renew" => $autoRenew,
            "ns" => $ns,
        ];

        $info = $this->call("POST", $this->urlPrefix . '/' . $domain . '/renew', $postData);
        return $info;
    }

    public function transferOut($domain, $nominetTag)
    {
        $info = $this->call("POST", $this->urlPrefix . '/' . $domain . '/update', ["tag" => $nominetTag]);
        return $info;
    }

    public function update($domain)
    {
        throw new Exception(ErrorMsg::NOT_IMPLEMENTED);
    }

}