<?php

namespace Zsardarov\Msg\VO;

use Zsardarov\Msg\Exceptions\InvalidMessage;

final class Message
{
    private const MAX_ASCII_LENGTH = 160;
    private const MAX_UNICODE_LENGTH = 70;

    private $content;

    private function __construct(string $content)
    {
        $this->content = $content;
    }

    public static function createFrom(string $content): self
    {
        if (mb_check_encoding($content, 'ASCII')) {
            if (strlen($content) > self::MAX_ASCII_LENGTH) {
                throw InvalidMessage::maxAsciiLength(self::MAX_ASCII_LENGTH);
            }
        } else if (mb_strlen($content) > self::MAX_UNICODE_LENGTH) {
            throw InvalidMessage::maxUnicodeLength(self::MAX_UNICODE_LENGTH);
        }

        return new self($content);
    }

    public function toStr(): string
    {
        return $this->content;
    }
}
