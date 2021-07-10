<?php

namespace Structuremedia\Versio\Modules;

use Illuminate\Support\Arr;
use Structuremedia\Versio\Exception\Exception;
use Structuremedia\Versio\Exception\ErrorMsg;

class Tld extends BaseModule
{
    protected $arrayKey = 'ContactList';
    protected $urlPrefix = "tld";

    protected function cleanTld($tld)
    {
        return mb_strtolower(str_replace(".","",$tld));
    }

    public function get($tld)
    {
        $info = $this->call("GET",$this->urlPrefix . '/info/' . $this->cleanTld($tld));
        return Arr::get($info, "tldInfo")[0];
    }

    public function list()
    {
        $info = $this->call("GET",$this->urlPrefix . '/info');
        return Arr::get($info, "tldInfo");
    }

}