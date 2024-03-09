<?php

namespace Services\VinDecoder;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

final readonly class VinDecoderService implements VinDecoderContractor
{
    public function __construct(
        protected string $baseUrl,
        protected string $apiKey,
        protected Client $client,
    ){
    }

    public function decoder(string $vin_code): array
    {
        try {
            $response = $this->client->request('GET', '/vin_decoder_basic?vin=' . $vin_code, [
                'headers' => [
                    'X-RapidAPI-Host' => 'vin-decoder19.p.rapidapi.com',
                    'X-RapidAPI-Key' => $this->apiKey,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);

        }catch (ClientException $clientException){
            return json_decode($clientException->getResponse()->getBody(), true);
        }
    }

}
