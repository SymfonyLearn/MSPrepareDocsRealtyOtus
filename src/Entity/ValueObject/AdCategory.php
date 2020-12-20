<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

use InvalidArgumentException;

/**
 * Class AdCategory
 * @package App\Model\ValueObject
 * @ORM\Embeddable
 */
class AdCategory
{

    const MESSAGE_IS_EMPTY_VALUE = 'Пустое значение';
    const MESSAGE_IS_INCORRECT_VALUE = 'Неправильное значение';

    const ALLOWED_CATEGORIES = [
        'Квартира',
        'Дом',
        'Участок',
    ];

    /**
     * Категория объявления
     * @var string $value
     * @ORM\Column(type="string", length=255)
     */
    private string $value;

    /**
     * AdCategory constructor.
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
        $this->assertIsCorrectState($value);
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

    /**
     * Проверить, что значение состояния корректное.
     * @param $value
     */
    private function assertIsCorrectState($value)
    {
        if (!in_array($value, self::ALLOWED_CATEGORIES)) {
            throw new InvalidArgumentException(self::MESSAGE_IS_INCORRECT_VALUE);
        }
    }
}
