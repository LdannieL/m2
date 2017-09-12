<?php

namespace Training1\FreeGeoIp\Model;

use Training1\FreeGeoIp\Api\DefineVisitorsCountryInterface;
use Magento\Framework\HTTP\ClientFactory as HttpClientFactory;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class DefineVisitorsCountry implements DefineVisitorsCountryInterface
{
    private $httpClientFactory;
    private $remoteAddress;

    /**
     * DefineVisitorsCountry constructor.
     */
    public function __construct(HttpClientFactory $httpClientFactory, RemoteAddress $remoteAddress)
    {
        $this->httpClientFactory = $httpClientFactory;
        $this->remoteAddress = $remoteAddress;
    }

    private function getVisitorIP($deep_detect = TRUE)
    {
        // $ip = $_SERVER["REMOTE_ADDR"];
        // if ($deep_detect) {
        //     if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
        //         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        //     if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
        //         $ip = $_SERVER['HTTP_CLIENT_IP'];
        // }

        // // return $ip;
        return '188.117.226.138';

        /** @var \Magento\Framework\ObjectManagerInterface $om */
        //$om = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $a */
        //$a = $om->get('Magento\Framework\HTTP\PhpEnvironment\RemoteAddress');
        //return $a->getRemoteAddress();
        
        //Ovo je ispravan Magento way
        //return $this->remoteAddress->getRemoteAddress();
    }

    /**
     * @param mixed $response
     * @return bool
     */
    private function hasCountryName($response)
    {
        return is_array($response)
            && isset($response['country_name']);
    }

    /**
     * @param string $ip
     * @return string
     */
    public function getCountry()
    {
        $ip = $this->getVisitorIP();
        // var_dump($ip);exit;
        $httpClient = $this->httpClientFactory->create();
        $httpClient->get('http://freegeoip.net/json/' . $ip);
        $response = json_decode($httpClient->getBody(), true);
        return $this->hasCountryName($response) ?
            $response['country_name'] :
            '';
    }
}