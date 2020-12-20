<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\Rooms;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RoomsTest extends TestCase
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
            (new Rooms($value))->value()
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
            [2],
            [3],
            [999],
            [1234567890],
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
        $this->expectExceptionMessage(Rooms::MESSAGE_IS_NOT_POSITIVE_NUMBER);

        new Rooms($value);
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
        $value1 = new Rooms(123);
        $value2 = new Rooms(123);

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
        $value1 = new Rooms(1234);
        $value2 = new Rooms(999);

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
