<?php

namespace Zsardarov\Msg\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Zsardarov\Msg\VO\GatewayResult;

class GatewayResultTest extends TestCase
{
    public function testResult()
    {
        $result = GatewayResult::fromResponse('00000-4323323');

        $this->assertEquals('00000', $result->getStatusCode());
        $this->assertEquals('4323323', $result->getMessageId());
    }
}
