<?php

namespace Zsardarov\Msg\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Zsardarov\Msg\Exceptions\InvalidMessage;
use Zsardarov\Msg\VO\Message;

class MessageTest extends TestCase
{
    public function testValidAsciiContent()
    {
        $content = 'Sample text';
        $message = Message::createFrom($content);

        $this->assertEquals($content, $message->toStr());
    }

    public function testValidUnicodeContent()
    {
        $content = 'შეტყობინება';
        $message = Message::createFrom($content);

        $this->assertEquals($content, $message->toStr());
    }

    public function testInvalidContent()
    {
        $content = <<<EOD
Lorem Ipsum is simply dummy text of the printing and typesetting industry.
Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
when an unknown printer took a galley of type and scrambled it to make a type specimen book.
It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
EOD;

        $this->expectException(InvalidMessage::class);
        $this->expectExceptionMessage('Message length exceeds 160 ascii characters.');
        Message::createFrom($content);
    }
}
