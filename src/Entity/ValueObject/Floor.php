<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

use InvalidArgumentException;

/**
 * Class Floor
 * @package App\Model\ValueObject
 * @ORM\Embeddable
 */
class Floor
{

    const MESSAGE_IS_NOT_POSITIVE_NUMBER = 'Значение не является положительным числом';

    /**
     * Этаж (для квартир)
     * @var int $value
     * @ORM\Column(type="integer")
     */
    private int $value;

    /**
     * DealId constructor.
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
     * Проверить, что значение больше 0.
     * @param int $value
     */
    private function assertIsPositiveNumber(int $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException(self::MESSAGE_IS_NOT_POSITIVE_NUMBER);
        }
    }
}
