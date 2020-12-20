<?php

namespace UnitTests\Model\ValueObject;

use App\Entity\ValueObject\DateCreated;
use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class DateCreatedTest extends TestCase
{
    /**
     * @testdox Создание объектов с корректным значением.
     * @test
     * @dataProvider  dataProviderValidValue
     * @param DateTimeImmutable $value
     * @return void
     */
    public function ValueGetsCreatedWithValidCharacters(DateTimeImmutable $value): void
    {
        $this->assertEquals(
            $value,
            (new DateCreated($value))->value()
        );
    }

    /**
     * Данные для теста "Создание объектов с корректным значением".
     * @return array
     */
    public function dataProviderValidValue(): array
    {
        return [
            [new DateTimeImmutable('now')],
            [new DateTimeImmutable('-1 day')],
            [new DateTimeImmutable('-1 week')],
            [new DateTimeImmutable('2000-01-01')],
        ];
    }

    /**
     * @testdox Создание объектов с некорректным значением.
     * @test
     * @dataProvider  dataProviderInvalidValue
     * @param DateTimeImmutable $value
     * @return void
     */
    public function ValueGetsCreatedWithInvalidValue(DateTimeImmutable $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(DateCreated::MESSAGE_NOT_FUTURE_DATE);

        new DateCreated($value);
    }

    /**
     * Данные для теста "Создание объектов с отрицательным/нулевым значением".
     * @return array
     */
    public function dataProviderInvalidValue(): array
    {
        return [
            [new DateTimeImmutable('tomorrow')],
            [new DateTimeImmutable('+1 day')],
            [new DateTimeImmutable('2055-12-01')],
        ];

    }

    /**
     * @testdox Проверка метода equalsTo(), два объекта равны друг другу.
     * @test
     * @return void
     * @throws \Exception
     */
    public function twoEqualValuesAreEqual(): void
    {
        $datetime1 = new DateTimeImmutable('11.07.2012');
        $datetime2 = new DateTimeImmutable('11.07.2012');

        $value1 = new DateCreated($datetime1);
        $value2 = new DateCreated($datetime2);

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
        $value1 = new DateCreated(new DateTimeImmutable('now'));
        $value2 = new DateCreated(new DateTimeImmutable('-1 day'));

        $this->assertFalse($value1->equalsTo($value2));
        $this->assertFalse($value2->equalsTo($value1));
    }
}
