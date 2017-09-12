<?php

namespace Mage2Kata\CustomerShortName;

/**
 * @group external
 */
class HypocorismsApiBehaviorTest extends \PHPUnit_Framework_TestCase
{
//    public function testIsThisOn()
//    {
//        $this->fail('HALT!');
//    }

    private $apiUrl = 'http://hypocorisms.vinaikopp.com/name/';

    public function testReturnsJSON()
    {
        json_decode(\file_get_contents($this->apiUrl));
        $this->assertSame(\JSON_ERROR_NONE, json_last_error(), 'JSON decode error: ' . json_last_error_msg());
    }

    public function testReturnsEmptyArrayIfNoMatchIsFound()
    {
        $response = json_decode(\file_get_contents($this->apiUrl . 'THIS IS NOT A NAME'), true);

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('data', $response);

        $this->assertInternalType('array', $response['data']);
        $this->assertArrayHasKey('hypocorisms', $response['data']);

        $this->assertInternalType('array', $response['data']['hypocorisms']);
        $this->assertEmpty($response['data']['hypocorisms']);
        //$this->assertNotEmpty($response['data']['hypocorisms']); //to fail
    }

    public function testReturnsHypocorismsAsArray()
    {
        $response = json_decode(\file_get_contents($this->apiUrl . 'Robert'), true);

        $this->assertInternalType('array', $response);
        $this->assertArrayHasKey('data', $response);

        $this->assertInternalType('array', $response['data']);
        $this->assertArrayHasKey('hypocorisms', $response['data']);

        $this->assertInternalType('array', $response['data']['hypocorisms']);
        $this->assertContains('Bob', $response['data']['hypocorisms']);
        $this->assertNotContains('Robert', $response['data']['hypocorisms']);
    }
}