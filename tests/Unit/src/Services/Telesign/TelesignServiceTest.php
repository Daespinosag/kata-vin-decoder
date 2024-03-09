<?php

namespace Tests\Unit\src\Services\Telesign;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Services\Telesing\TelesignService;
use Tests\TestCase;

class TelesignServiceTest extends TestCase
{
    /** @test */
    public function it_sends_a_verification_code()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode(['success' => true])),
        ]);

        $handlerStack   = HandlerStack::create($mock);
        $client         = new Client(['handler' => $handlerStack]);
        $service        = new TelesignService('base_url', 'customer_id', 'api_key', $client);
        $response       = $service->sendVerificationCode(573122437000, 57244);

        $this->assertEquals(['success' => true], $response);
    }

    /** @test */
    public function it_handles_bad_request_error()
    {
        $mock = new MockHandler([
            new Response(400, [], json_encode(['reference_id' => null])),
        ]);


        $handlerStack   = HandlerStack::create($mock);
        $client         = new Client(['handler' => $handlerStack]);
        $service        = new TelesignService('base_url', 'customer_id', 'api_key', $client);
        $response       = $service->sendVerificationCode(573122437949000, 57244);

        $this->assertEquals(['reference_id' => null], $response);
    }
}
