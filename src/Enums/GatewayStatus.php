<?php

namespace Zsardarov\Msg\Enums;

final class GatewayStatus
{
    public const ACCEPTED = '0000';
    public const WRONG_CREDENTIALS_OR_IP = '0001';
    public const EMPTY_FIELDS = '0003';
    public const EMPTY_TEXT = '0005';
    public const INCORRECT_NUMBER = '0007';
    public const INSUFFICIENT_BALANCE = '0008';
    public const BRAND_NAME_NOT_FOUND = '0009';
    public const FORBIDDEN_WORD = '0010';
}
