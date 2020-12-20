<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\Floor;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class FloorTest extends TestCase
{
    /**
     * @testdox Создание объектов с корректным значением.
     * @test
     * @dataProvider  dataProviderValidValue
     * @param int $value
     * @return void
     */
    public function ValueGetsCreatedWithValidCharacters(int $value): void
    {
        $this->assertEquals(
            $value,
            (new Floor($value))->value()
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
            [13],
            [20],
            [999],
        ];
    }

    /**
     * @testdox Создание объектов с отрицательным/нулевым значением.
     * @test
     * @dataProvider  dataProviderInvalidValue
     * @param int $value
     * @return void
     */
    public function ValueGetsCreatedWithEmptyValue($value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(Floor::MESSAGE_IS_NOT_POSITIVE_NUMBER);

        new Floor($value);
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
        $value1 = new Floor(13);
        $value2 = new Floor(13);

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
        $value1 = new Floor(1234);
        $value2 = new Floor(999);

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
