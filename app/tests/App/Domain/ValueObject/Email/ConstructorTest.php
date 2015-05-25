<?php

namespace UnitTest\App\Domain\ValueObject\Email;

use App\Domain\ValueObject\Email;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $word = 'test@example.com'; // 6 characters
        $email = new Email($word);
        $this->assertSame($word, $email->getEmail());
        $this->assertSame($word, (string) $email);
    }

    /**
     * @dataProvider providerOfInvalidEmails
     * @param string $email
     */
    public function testIllegalEmails($email)
    {
        $this->setExpectedException('App\Domain\Exception\ValidationException');
        new Email($email);
    }

    public function providerOfInvalidEmails()
    {
        return [
            [''],
            [1],
            [null],
            ['example'],
            ['example.com'],
            ['@example.com'],
            ['name@'],
            ['!@!.com']
        ];
    }
}
