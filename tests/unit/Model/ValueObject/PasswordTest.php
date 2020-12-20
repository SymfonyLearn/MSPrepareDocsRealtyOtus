<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\Password;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
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
            (new Password($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            ['gsthdt8r695ywr'],
            ['@##%^&RTUSFH'],
            ['USA,_Fort-Nox==F'],
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
        $this->expectExceptionMessage(Password::MESSAGE_IS_EMPTY_VALUE);

        new Password('');
    }

    /**
     * @testdox Проверка метода equalsTo(), два объекта равны друг другу.
     * @test
     * @return void
     */
    public function twoEqualValuesAreEqual(): void
    {
        $value1 = new Password('dfght6wqae4rt5h');
        $value2 = new Password('dfght6wqae4rt5h');

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
        $value1 = new Password('asfasdfa8fa68686');
        $value2 = new Password('12342hj34itsudh');

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
