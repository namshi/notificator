<?php

namespace Namshi\Notificator\Notification\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use Psr\Log\LoggerInterface;

class Kahuna
{
    const API_BASE_URL = 'https://tap-nexus.appspot.com/api';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $environment;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(ClientInterface $client, $username, $password, $environment = 'p', LoggerInterface $logger)
    {
        $this->client      = $client;
        $this->username    = $username;
        $this->password    = $password;
        $this->environment = $environment;
        $this->logger      = $logger;
    }

    /**
     * Sends push notification using Kahuna Push API
     *
     * @see https://app.usekahuna.com/tap/public_docs/Content/APIs/Push.htm
     *
     * @param array $pushArray
     * @param array $defaultParams
     * @param array $defaultConfig
     *
     * @return bool
     */
    public function sendPush(array $pushArray, array $defaultParams = [], array $defaultConfig = [])
    {
        try {
            $response = $this->client->request(
                'POST',
                self::API_BASE_URL . '/push?env=' . $this->environment,
                [
                    'auth' => [$this->username, $this->password],
                    'json' => $this->buildPayLoad($pushArray, $defaultParams, $defaultConfig)
                ]
            );

            if (200 === $response->getStatusCode()) {
                $responseBody = json_decode($response->getBody(), true);
                if ($responseBody[0]['success']) {
                    $this->logger->info(
                        'Push notification sent successfully',
                        ['responseCode' => $response->getStatusCode(), 'responseBody' => $response->getBody()]
                    );

                    return true;
                }
            }

            $this->logger->error(
                'Push notification could not be sent to Kahuna',
                ['responseCode' => $response->getStatusCode(), 'responseBody' => $response->getBody()]
            );

            return false;
        } catch(ClientException $e) {

            $response = $e->getResponse();
            $context = [
                'message' => $e->getMessage(),
                'traceAsString'  => $e->getTraceAsString()
            ];

            if ($response) {
                $context['responseCode'] = $response->getStatusCode();
                $context['responseBody'] = \GuzzleHttp\Psr7\str($response);
            }

            $this->logger->error('Error while sending push notification to Kahuna : ' . $e->getMessage() , $context);

            return false;
        }
    }

    protected function buildPayload(array $pushArray, array $defaultParams, array $defaultConfig)
    {
        $payload = ['push_array' => $pushArray];

        if(!empty($defaultParams)) {
            $payload['default_params']= $defaultParams;
        }

        if (!empty($defaultConfig)) {
            $payload['default_config'] = $defaultConfig;

        }

        return $payload;
    }
}
