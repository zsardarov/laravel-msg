<?php

namespace Zsardarov\Msg\Exceptions;

class InvalidMessage extends \Exception
{
    public static function maxUnicodeLength(int $value): InvalidMessage
    {
        return new static("Message length exceeds {$value} unicode characters.");
    }

    public static function maxAsciiLength(int $value): InvalidMessage
    {
        return new static("Message length exceeds {$value} ascii characters.");
    }
}
