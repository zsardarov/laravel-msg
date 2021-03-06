<?php

namespace Zsardarov\Msg\Facades;

use Illuminate\Support\Facades\Facade;
use Zsardarov\Msg\MsgService;

class MSG extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return MsgService::class;
    }
}
