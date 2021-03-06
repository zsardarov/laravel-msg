<?php

namespace Zsardarov\Msg\Enums;

final class DeliveryStatus
{
    public const PENDING = 0;
    public const SENT = 1;
    public const NOT_SENT = 2;
    public const WAITING_STATUS = 4;
    public const PASSED = 8;
    public const NOT_PASSED = 16;
    public const WRONG_CREDENTIALS_OR_IP = 64;
}
