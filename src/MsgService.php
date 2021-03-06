<?php

namespace Zsardarov\Msg;

use GuzzleHttp\Client;
use Illuminate\Config\Repository;
use Zsardarov\Msg\VO\GatewayResult;
use Zsardarov\Msg\VO\Message;

class MsgService
{
    private $serviceId;
    private $clientId;
    private $username;
    private $password;
    private $httpClient;

    private const URI = 'http://bi.msg.ge';

    public function __construct(Repository $config)
    {
        $this->serviceId = $config->get('msg.service_id');
        $this->clientId = $config->get('msg.client_id');
        $this->username = $config->get('msg.username');
        $this->password = $config->get('msg.password');

        $headers = $config->get('msg.alt_password') ? ['MSG_HEADER' => $config->get('msg.alt_password')] : [];
        $this->httpClient = new Client([
            'base_uri' => self::URI,
            'headers' => $headers
        ]);
    }

    public function send(string $number, string $text): GatewayResult
    {
        $message = Message::createFrom($text);

        $response = (string) $this->httpClient->request('GET', '/sendsms.php', [
            'query' => [
                'to' => $number,
                'text' => $message->toStr(),
                'service_id' => $this->serviceId,
                'client_id' => $this->clientId,
                'password' => $this->password,
                'username' => $this->username,
                'utf' => 1
            ]
        ])->getBody();

        return GatewayResult::fromResponse($response);
    }


    public function status(string $messageId): int
    {
        $response = (string) $this->httpClient->request('GET', '/track.php', [
            'query' => [
                'message_id' => $messageId,
                'client_id' => $this->clientId,
                'password' => $this->password,
                'username' => $this->username,
            ]
        ])->getBody();

        return intval($response);
    }
}
