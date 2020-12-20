<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\Area;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AreaTest extends TestCase
{
    /**
     * @testdox Создание объектов с корректным значением.
     * @test
     * @dataProvider  dataProviderValidValue
     * @param float $value
     * @return void
     */
    public function ValueGetsCreatedWithValidCharacters(float $value): void
    {
        $this->assertEquals(
            $value,
            (new Area($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            [1],
            [1.5],
            [20],
            [21.4],
            [999],
        ];
    }

    /**
     * @testdox Создание объектов с отрицательным/нулевым значением.
     * @test
     * @dataProvider  dataProviderInvalidValue
     * @param float $value
     * @return void
     */
    public function ValueGetsCreatedWithEmptyValue(float $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Area::MESSAGE_IS_NOT_POSITIVE_NUMBER);

        new Area($value);
    }

    /**
     * Данные для теста "Создание объектов с отрицательным/нулевым значением".
     * @return array
     */
    public function dataProviderInvalidValue(): array
    {
        return [
            [0],
            [-1],
            [-10.5],
            [-999],
        ];

    }

    /**
     * @testdox Проверка метода equalsTo(), два объекта равны друг другу.
     * @test
     * @return void
     */
    public function twoEqualValuesAreEqual(): void
    {
        $value1 = new Area(1234567890);
        $value2 = new Area(1234567890);

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
        $value1 = new Area(1234567890);
        $value2 = new Area(99999);

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
