<?php

namespace Zsardarov\Msg\VO;

final class GatewayResult
{
    private $statusCode;
    private $messageId;

    private function __construct(string $statusCode, string $messageId)
    {
        $this->statusCode = $statusCode;
        $this->messageId = $messageId;
    }

    public static function fromResponse(string $response): self
    {
        list($statusCode, $messageId) = explode('-', $response);

        return new self($statusCode, $messageId);
    }

    public function getStatusCode(): string
    {
        return $this->statusCode;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }
}
