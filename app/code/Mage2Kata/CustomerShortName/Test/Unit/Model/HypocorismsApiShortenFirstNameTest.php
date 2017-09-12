<?php

namespace Mage2Kata\CustomerShortName\Model;

use Mage2Kata\CustomerShortName\Api\ShortenFirstNameInterface;
use Magento\Framework\HTTP\ClientInterface as HttpClient;
use Magento\Framework\HTTP\ClientFactory as HttpClientFactory;

class HypocorismsApiShortenFirstNameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpClient|\PHPUnit_Framework_MockObject_MockObject
     */
    private $mockHttpClient;

    /**
     * @param string $expected
     * @param string $firstname
     */
    private function assertShortName($expected, $firstname)
    {
        /** @var HttpClientFactory|\PHPUnit_Framework_MockObject_MockObject $mockHttpClientFactory */
        $mockHttpClientFactory = $this->getMock(HttpClientFactory::class, [], [], '', false);
        $mockHttpClientFactory->method('create')->willReturn($this->mockHttpClient);
        $this->assertSame($expected, (new HypocorismsApiShortenFirstName($mockHttpClientFactory))->shorten($firstname));
    }

    protected function setUp()
    {
        $this->mockHttpClient = $this->getMock(HttpClient::class);
    }

    public function testImplementsShortensFirstNameInterface()
    {
        $mockHttpClientFactory = $this->getMock(HttpClientFactory::class, [], [], '', false);
        $this->assertInstanceOf(ShortenFirstNameInterface::class, new HypocorismsApiShortenFirstName($mockHttpClientFactory));
    }

//    public function testReturnsTheGivenNameIfApiResponseIsInvalid()
//    {
//        /** @var HttpClient|\PHPUnit_Framework_MockObject_MockObject */
//        $mockHttpClient = $this->getMock(HttpClient::class);
//        $mockHttpClient->expects($this->once())->method('getBody')->willReturn('');
//        $mockHttpClientFactory = $this->getMock(HttpClientFactory::class, [], [], '', false);
//        /** @var HttpClientFactory|\PHPUnit_Framework_MockObject_MockObject $mockHttpClientFactory */
//        $mockHttpClientFactory->method('create')->willReturn($mockHttpClient);
//        $this->assertSame('Foo', (new HypocorismsApiShortenFirstName($mockHttpClientFactory))->shorten('Foo'));
//    }

    //Refactored
//    public function testReturnsTheGivenNameIfApiResponseIsInvalid()
//    {
//        $invalidResponse = '';
//        $this->mockHttpClient->method('getBody')->willReturn($invalidResponse);
//        /** @var HttpClientFactory|\PHPUnit_Framework_MockObject_MockObject $mockHttpClientFactory */
//        $mockHttpClientFactory = $this->getMock(HttpClientFactory::class, [], [], '', false);
//        $mockHttpClientFactory->method('create')->willReturn($this->mockHttpClient);
//        $this->assertSame('Foo', (new HypocorismsApiShortenFirstName($mockHttpClientFactory))->shorten('Foo'));
//        $this->mockHttpClient->method('getBody')->willReturn($invalidResponse);
//        $this->assertShortName('Foo', 'Foo');
//    }

//    public function testReturnsTheGivenNameIfApiResponseIsInvalid()
//    {
//        $this->mockHttpClient->expects($this->once())->method('getBody')->willReturn('');
//        $this->assertShortName('Foo', 'Foo');
//    }

    /**
     * @param mixed $invalidResponse
     * @dataProvider invalidApiResponseDataProvider
     */
    public function testReturnsTheGivenNameIfApiResponseIsInvalid($invalidResponse)
    {
        $this->mockHttpClient->method('getBody')->willReturn($invalidResponse);
        $this->assertShortName('Foo', 'Foo');
    }

    public function invalidApiResponseDataProvider()
    {
        return [
            [''],
            [false],
            [null],
            [json_encode([])],
            [json_encode(['data' => ''])],
            [json_encode(['data' => []])],
            [json_encode(['data' => ['hypocorisms' => '']])],
            [json_encode(['data' => ['hypocorisms' => []]])],

        ];
    }

    public function testReturnsFirstHypocorismIfPresent()
    {
        $response = json_encode(['data' => ['hypocorisms' => ['Bar', 'Baz']]]);
        $this->mockHttpClient->expects($this->once())->method('getBody')->willReturn($response);
//        $this->mockHttpClient->method('getBody')->willReturn($response);
        $this->mockHttpClient->expects($this->once())->method('get')->with($this->stringEndsWith('/Foo'));
        $this->assertShortName('Bar', 'Foo');

//        $this->mockHttpClient->expects($this->once())->method('get')->with($this->stringEndsWith('/Foo'));
    }
}