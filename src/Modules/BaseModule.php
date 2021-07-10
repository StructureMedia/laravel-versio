<?php

namespace Structuremedia\Versio\Modules;

use Illuminate\Support\Facades\Http;
use Structuremedia\Versio\Exception\Exception;
use Structuremedia\Versio\Exception\ErrorMsg;

class BaseModule
{
    const VERSION = 'v1';

    protected $url;
    protected $query;
    protected $callableUrl;

    public function __construct()
    {   
        $this->baseUrl = 'https://www.versio.nl';

        if (config('versio.test') || true) {
            $this->baseUrl .= '/testapi/' . self::VERSION . '/';
        } else {
            $this->baseUrl .= '/api/' . self::VERSION . '/';
        }

    }

    protected function call($method, $url, $postData = [])
    {   

        $method = mb_strtoupper($method);
        
        switch ($method) {
            case 'GET':
                $response = Http::acceptJson()->withBasicAuth(config('versio.email'), config('versio.password'))->get($this->baseUrl . $url);
                break;

            case 'POST':
                $response = Http::acceptJson()->withBasicAuth(config('versio.email'), config('versio.password'))->post($this->baseUrl . $url, $postData);
                break;

            case 'DELETE':
                $response = Http::acceptJson()->withBasicAuth(config('versio.email'), config('versio.password'))->delete($this->baseUrl . $url);
                break;
            
            default:
                throw new Exception(ErrorMsg::INVALID_METHOD);
                break;
        }

        switch ($response->status()) {
            case 404:
                throw new Exception(ErrorMsg::NOT_FOUND);
                break;
            
            case 400:
                throw new Exception($response->json()["error"]["message"]);
                break;
            
            case 401:
                throw new Exception($response->json()["error"]["message"]);
                break;
        }

        return $response->json();
    }

}