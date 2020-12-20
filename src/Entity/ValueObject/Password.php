<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;


use InvalidArgumentException;

/**
 * Class Password
 * @package App\Model\ValueObject
 * @ORM\Embeddable
 */
class Password
{

    const MESSAGE_IS_EMPTY_VALUE = 'Пустое значение';

    /**
     * Хэш пароля
     * @var string $value
     * @ORM\Column(type="string", length=255)
     */
    private string $value;

    /**
     * Password constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }

    /**
     * @param string $value
     */
    private function setValue(string $value): void
    {
        $this->assertIsNotEmpty($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Проверить, что значение состояние не пустое.
     * @param string $value
     */
    private function assertIsNotEmpty(string $value)
    {
        if (empty($value)) {
            throw new InvalidArgumentException(self::MESSAGE_IS_EMPTY_VALUE);
        }
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
}
