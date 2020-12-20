<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

use InvalidArgumentException;

/**
 * Class Area
 * @package App\Model\ValueObject
 * @ORM\Embeddable
 */
class Area
{

    const MESSAGE_IS_NOT_POSITIVE_NUMBER = 'Значение не является положительным числом';

    /**
     * Площадь, кв.м.
     * @var float $value
     * @ORM\Column(type="float")
     */
    private float $value;

    /**
     * Area constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->setValue($value);
    }

    /**
     * @param float $value
     */
    private function setValue(float $value): void
    {
        $this->assertIsPositiveNumber($value);
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function value(): float
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
     * @param float $value
     */
    private function assertIsPositiveNumber(float $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException(self::MESSAGE_IS_NOT_POSITIVE_NUMBER);
        }
    }
}
