<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\Address;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
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
            (new Address($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            ['123456, Москва, Кремль, д.1'],
            ['Коломенское'],
            ['USA, Fort Nox'],
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
        $this->expectExceptionMessage(Address::MESSAGE_IS_EMPTY_VALUE);

        new Address('');
    }

    /**
     * @testdox Проверка метода equalsTo(), два объекта равны друг другу.
     * @test
     * @return void
     */
    public function twoEqualValuesAreEqual(): void
    {
        $value1 = new Address('123456, Москва, Кремль, д.1');
        $value2 = new Address('123456, Москва, Кремль, д.1');

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
        $value1 = new Address('123456, Москва, Кремль, д.1');
        $value2 = new Address('ЗиКоломенскоегфрид');

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
