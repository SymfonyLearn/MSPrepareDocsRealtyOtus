<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /**
     * @testdox Создание объектов с корректным значением.
     * @test
     * @dataProvider  dataProviderValidValue
     * @param string $value
     * @return void
     */
    public function ValueGetsCreatedWithValidCharacters(string $value): void
    {
        $this->assertEquals(
            $value,
            (new Email($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            ['qqq@qqq.com'],
            ['qqq@qqq5555.ru'],
            ['qqq5555@qqq5555.net'],
            ['qqq5555-rrr@qqq5555.it'],
        ];
    }

    /**
     * @testdox Создание объектов с пустым значением.
     * @test
     * @return void
     */
    public function ValueGetsCreatedWithEmptyValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Email::MESSAGE_IS_EMPTY_VALUE);

        new Email('');
    }

    /**
     * @testdox Создание объектов с корректным значением.
     * @test
     * @dataProvider  dataProviderInvalidValue
     * @param string $value
     * @return void
     */
    public function ValueGetsCreatedWithInvalidCharacters(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Email::MESSAGE_IS_NOT_VALID_VALUE);

        $this->assertEquals(
            $value,
            (new Email($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с некорректным значением".
     * @return array
     */
    public function dataProviderInvalidValue(): array
    {
        return [
            ['zzz@@zzz.com'],
            ['zzz@.com'],
            ['zzz@ttttt'],
            ['Договор'],
            ['Shop'],
            ['Chopper1697'],
        ];
    }

    /**
     * @testdox Проверка метода equalsTo(), два объекта равны друг другу.
     * @test
     * @return void
     */
    public function twoEqualValuesAreEqual(): void
    {
        $value1 = new Email('testmail@testmail.ru');
        $value2 = new Email('testmail@testmail.ru');

        $this->assertTrue($value1->equalsTo($value2));
        $this->assertTrue($value2->equalsTo($value1));
    }

    /**
     * @testdox Проверка метода equalsTo(), два объекта не равны друг другу.
     * @test
     * @return void
     */
    public function twoDifferentValuesAreNotEqual(): void
    {
        $value1 = new Email('testmail@testmail.ru');
        $value2 = new Email('testmail2222@testmail2222.ru');

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
