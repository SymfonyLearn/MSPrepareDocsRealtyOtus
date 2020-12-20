<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\AdCategory;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AdCategoryTest extends TestCase
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
            (new AdCategory($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            ['Квартира'],
            ['Дом'],
            ['Участок'],
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
        $this->expectExceptionMessage(AdCategory::MESSAGE_IS_EMPTY_VALUE);

        new AdCategory('');
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
        $this->expectExceptionMessage(AdCategory::MESSAGE_IS_INCORRECT_VALUE);

        $this->assertEquals(
            $value,
            (new AdCategory($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с некорректным значением".
     * @return array
     */
    public function dataProviderInvalidValue(): array
    {
        return [
            ['Этаж'],
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
        $value1 = new AdCategory('Квартира');
        $value2 = new AdCategory('Квартира');

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
        $value1 = new AdCategory('Квартира');
        $value2 = new AdCategory('Участок');

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }

}
