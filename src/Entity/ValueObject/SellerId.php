<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use InvalidArgumentException;

/**
 * Class SellerId
 * @package App\Model\ValueObject
 */
class SellerId
{

    const MESSAGE_IS_NOT_POSITIVE_NUMBER = 'Значение не является положительным числом';

    /**
     * ID продавца
     * @var int $value
     */
    private int $value;

    /**
     * SellerId constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    /**
     * @param int $value
     */
    private function setValue(int $value): void
    {
        $this->assertIsPositiveNumber($value);
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * Сравнение 2-ух объектов
     * @param self $otherValue
     * @return bool
     */
    public function equalsTo(self $otherValue): bool
    {
        return $this->value() === $otherValue->value();
    }

    /**
     * Проверить, что значение положительное число (больше 0).
     * @param int $value
     */
    private function assertIsPositiveNumber(int $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException(self::MESSAGE_IS_NOT_POSITIVE_NUMBER);
        }
    }
}
