<?php

namespace Training3\ExchangeRate\Model;

// use Training1\FreeGeoIp\Api\DefineVisitorsCountryInterface;
use Magento\Framework\HTTP\ClientFactory as HttpClientFactory;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class ExchangeRate 
//implements DefineVisitorsCountryInterface
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
    public function getExchangeRate()
    {
        $currency = 'USD';
        $httpClient = $this->httpClientFactory->create();
        $httpClient->get('http://api.fixer.io/latest?base=' . $currency);
        $response = json_decode($httpClient->getBody(), true);
        return $response['rates']['EUR'];
        // var_dump($response);
        // return $this->hasCountryName($response) ?
        //     $response['country_name'] :
        //     '';
    }
}