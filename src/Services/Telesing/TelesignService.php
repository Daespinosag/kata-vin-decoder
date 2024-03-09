<?php /** @noinspection ALL */

namespace Services\Telesing;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use PhpParser\Node\Stmt\TryCatch;

final readonly class TelesignService implements TelesignContract
{
    public function __construct(
        private string $baseUrl,
        private string $customerId,
        private string $apiKey,
        private Client $client,
    ){
    }

    public function sendVerificationCode(int $phoneNumber, int $verifyCode): array
    {
        try {
            $response = $this->client->request('POST', '/v1/verify/sms', [
                'form_params' => [
                    'is_primary'    => true,
                    'phone_number'  => $phoneNumber,
                    'verify_code'   => $verifyCode,
                ],
                'headers' => $this->prepareHeaders(),
            ]);

            return json_decode($response->getBody()->getContents(), true);

        }catch (ClientException $clientException){
            return json_decode($clientException->getResponse()->getBody(), true);
        }
    }

    public function validateVerificationCode(string $verificationId, int $verifyCode): array
    {
        try {
            $response = $this->client->request('GET', "/v1/verify/$verificationId?verify_code=$verifyCode", [
                'headers' => $this->prepareHeaders(),
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (ClientException $clientException){
            return json_decode($clientException->getResponse()->getBody(), true);
        }
    }

    private function prepareHeaders(): array
    {
        return [
            'Accept'        => 'application/json',
            'Authorization' => $this->generateAuthorizationHeader(),
            'Content-Type'  => 'application/x-www-form-urlencoded',
        ];
    }

    private function generateAuthorizationHeader() : string
    {
        $credentials                = $this->customerId . ':' . $this->apiKey;
        $base64EncodedCredentials   = base64_encode($credentials);
        $authorizationHeader        = 'Basic ' . $base64EncodedCredentials;

        return $authorizationHeader;
    }

}

