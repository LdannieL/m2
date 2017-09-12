<?php

namespace Mage2Kata\CustomerShortName\Model;

use Mage2Kata\CustomerShortName\Api\ShortenFirstNameInterface;
use Magento\Framework\HTTP\ClientFactory as HttpClientFactory;

class HypocorismsApiShortenFirstName implements ShortenFirstNameInterface
{
    private $httpClientFactory;

    /**
     * HypocorismsApiShortenFirstName constructor.
     */
    public function __construct(HttpClientFactory $httpClientFactory)
    {
        $this->httpClientFactory = $httpClientFactory;
    }

//    /**
//     * @param string $firstname
//     * @return string
//     */
//    public function shorten($firstname)
//    {
////        return $firstname;
//
//        $httpClient = $this->httpClientFactory->create();
//        //$httpClient->get('http://hypocorisms.vinaikopp.com/name/' . $firstname);
//        $response = @json_decode($httpClient->getBody(), true);
//        if (is_array($response)
//            && isset($response['data']) && is_array($response['data'])
//            && isset($response['data']['hypocorisms']) && is_array($response['data']['hypocorisms'])
//            && count($response['data']['hypocorisms']) > 0
//        ) {
//            return $response['data']['hypocorisms'][0];
//        }
//        return $firstname;
//    }

    /**
     * @param mixed $response
     * @return bool
     */
    private function hasHypocorisms($response)
    {
        return is_array($response)
        && isset($response['data'])
        && is_array($response['data'])
        && isset($response['data']['hypocorisms'])
        && is_array($response['data']['hypocorisms'])
        && count($response['data']['hypocorisms']) > 0;
    }

//    /**
//     * @param string $firstname
//     * @return string
//     */
//    public function shorten($firstname)
//    {
//        $httpClient = $this->httpClientFactory->create();
//        $httpClient->get('http://hypocorisms.vinaikopp.com/name/' . $firstname);
//        $response = @json_decode($httpClient->getBody(), true);
//        if ($this->hasHypocorisms($response)) {
//            return $response['data']['hypocorisms'][0];
//        }
//        return $firstname;
//    }

    /**
     * @param string $firstname
     * @return string
     */
    public function shorten($firstname)
    {
        $httpClient = $this->httpClientFactory->create();
        $httpClient->get('http://hypocorisms.vinaikopp.com/name/' . $firstname);
        $response = json_decode($httpClient->getBody(), true);
        return $this->hasHypocorisms($response) ?
            $response['data']['hypocorisms'][0] :
            $firstname;
    }
}