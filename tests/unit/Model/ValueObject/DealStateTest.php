<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\DealState;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DealStateTest extends TestCase
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
            (new DealState($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            ['Новая'],
            ['Договор подготовлен'],
            ['Договор подписан'],
            ['На регистрации'],
            ['Ошибка регистрации'],
            ['Регистрация завершена'],
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
        $this->expectExceptionMessage(DealState::MESSAGE_IS_EMPTY_VALUE);

        new DealState('');
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
        $this->expectExceptionMessage(DealState::MESSAGE_IS_INCORRECT_VALUE);

        $this->assertEquals(
            $value,
            (new DealState($value))->value()
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
        $value1 = new DealState('Договор подготовлен');
        $value2 = new DealState('Договор подготовлен');

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
        $value1 = new DealState('Договор подготовлен');
        $value2 = new DealState('Новая');

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
