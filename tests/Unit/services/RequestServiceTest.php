<?php

namespace Tests\Unit\services;

use PHPUnit\Framework\TestCase;
use Mockery;

class RequestServiceTest extends TestCase
{
    protected $sut;
    protected $response;
    
    protected function setUp(): void
    {
        parent::setup();

        $this->response = $response = 'A Response';
        
        $streamMock = Mockery::mock(\Psr\Http\Message\StreamInterface::class, function ($mock) use ($response) {
            $mock->shouldReceive('getContents')->andReturn($response);
        });
        $messageMock = Mockery::mock(\Psr\Http\Message\MessageInterface::class, function ($mock) use ($streamMock) {
            $mock->shouldReceive('getBody')->andReturn($streamMock);
        });
        $clientMock = Mockery::mock(\GuzzleHttp\Client::class, function ($mock) use ($messageMock) {
            $mock->shouldReceive('get')->andReturn($messageMock);
        });
        
        $this->sut = new \App\Services\RequestService($clientMock);;
    }
    
    public function testItMakesGetRequests()
    {
        $this->assertEquals($this->response, $this->sut->get(''));
    }
}
