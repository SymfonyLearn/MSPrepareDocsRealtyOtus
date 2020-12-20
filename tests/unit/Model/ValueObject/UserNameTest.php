<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\UserName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserNameTest extends TestCase
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
            (new UserName($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            ['Рабиндранат Рамарачакпа'],
            ['Пушкин'],
            ['Michael Jackson'],
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
        $this->expectExceptionMessage(UserName::MESSAGE_IS_EMPTY_VALUE);

        new UserName('');
    }

    /**
     * @testdox Проверка метода equalsTo(), два объекта равны друг другу.
     * @test
     * @return void
     */
    public function twoEqualValuesAreEqual(): void
    {
        $value1 = new UserName('Милица Покобатько');
        $value2 = new UserName('Милица Покобатько');

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
        $value1 = new UserName('Милица Андреевна Покобатько');
        $value2 = new UserName('Зигфрид');

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
