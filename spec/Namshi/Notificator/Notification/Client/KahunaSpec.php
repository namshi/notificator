<?php

namespace spec\Namshi\Notificator\Notification\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;

class KahunaSpec extends ObjectBehavior
{
    function let(ClientInterface $client, LoggerInterface $logger)
    {
        $this->beConstructedWith($client, 'username', 'password', 'p', $logger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Namshi\Notificator\Notification\Client\Kahuna');
    }

    function it_should_send_push_notification_with_basic_parameters_and_right_credentials_successfully(ClientInterface $client, Response $response)
    {
        $pushArray = [
            ['target' => ['email' => 'hey@mail.com'], 'notification' => ['alert' => 'Hey, like this!']]
        ];

        $payload = [
            'auth' => ['username', 'password'],
            'json' => ['push_array' => $pushArray]
        ];

        $client->request('POST', 'https://tap-nexus.appspot.com/api/push?env=p', $payload)->shouldBeCalled()->willReturn($response);
        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->getBody()->shouldBeCalled()->willReturn('[ { "success": true } ]');

        $this->sendPush($pushArray)->shouldReturn(true);
    }

    function it_should_send_push_notification_to_staging_environment_with_basic_parameters_and_right_credentials_successfully(
        ClientInterface $client,
        Response $response,
        LoggerInterface $logger
    )
    {
        $this->beConstructedWith($client, 'username', 'password', 's', $logger);

        $pushArray = [
            ['target' => ['email' => 'hey@mail.com'], 'notification' => ['alert' => 'Hey, like this!']]
        ];

        $payload = [
            'auth' => ['username', 'password'],
            'json' => ['push_array' => $pushArray]
        ];

        $client->request('POST', 'https://tap-nexus.appspot.com/api/push?env=s', $payload)->shouldBeCalled()->willReturn($response);
        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->getBody()->shouldBeCalled()->willReturn('[ { "success": true } ]');

        $this->sendPush($pushArray)->shouldReturn(true);
    }

    function it_should_not_send_push_notification_with_basic_parameters_and_wrong_credentials(
        ClientInterface $client,
        LoggerInterface $logger
    )
    {
        $this->beConstructedWith($client, 'username1', 'password1', 'p', $logger);

        $pushArray = [
            ['target' => ['email' => 'hey@mail.com'], 'notification' => ['alert' => 'Hey, like this!']]
        ];

        $payload = [
            'auth' => ['username1', 'password1'],
            'json' => ['push_array' => $pushArray]
        ];

        $client->request('POST', 'https://tap-nexus.appspot.com/api/push?env=p', $payload)->shouldBeCalled()->willThrow(ClientException::class);
        $logger->error('Error while sending push notification to Kahuna : ', Argument::any())->shouldBeCalled();

        $this->sendPush($pushArray)->shouldReturn(false);
    }

    function it_should_send_push_notification_with_default_config_parameters_and_right_credentials_successfully(ClientInterface $client, Response $response)
    {
        $pushArray = [
            ['target' => ['email' => 'hey@mail.com'], 'notification' => ['alert' => 'Hey, like this!']]
        ];
        $defaultConfig = [
            'start_time'              => 1441231830,
            'optimal_hours'           => 4,
            'influence_rate_limiting' => false,
            'observe_rate_limiting'   => false,
            'campaign_name'           => 'New user campaign'
        ];

        $payload = [
            'auth' => ['username', 'password'],
            'json' => ['default_config' => $defaultConfig, 'push_array' => $pushArray]
        ];

        $client->request('POST', 'https://tap-nexus.appspot.com/api/push?env=p', $payload)->shouldBeCalled()->willReturn($response);
        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->getBody()->shouldBeCalled()->willReturn('[ { "success": true } ]');

        $this->sendPush($pushArray, [], $defaultConfig)->shouldReturn(true);
    }

    function it_should_send_push_notification_with_all_parameters_and_right_credentials_successfully(ClientInterface $client, Response $response)
    {
        $pushArray = [
            ['target' => ['email' => 'hey@mail.com'], 'notification' => ['alert' => 'Hey, like this!']]
        ];
        $defaultParams = ['item_codes_on_sale' => ['KL_1356', 'KL_1400', 'KL_9502'], 'sale_landing_page' => 'sale_page_2015_09'];
        $defaultConfig = [
            'start_time'              => 1441231830,
            'optimal_hours'           => 4,
            'influence_rate_limiting' => false,
            'observe_rate_limiting'   => false,
            'campaign_name'           => 'New user campaign'
        ];

        $payload = [
            'auth' => ['username', 'password'],
            'json' => ['default_params' => $defaultParams, 'default_config' => $defaultConfig, 'push_array' => $pushArray]
        ];

        $client->request('POST', 'https://tap-nexus.appspot.com/api/push?env=p', $payload)->shouldBeCalled()->willReturn($response);
        $response->getStatusCode()->shouldBeCalled()->willReturn(200);
        $response->getBody()->shouldBeCalled()->willReturn('[ { "success": true } ]');

        $this->sendPush($pushArray, $defaultParams, $defaultConfig)->shouldReturn(true);
    }
}
