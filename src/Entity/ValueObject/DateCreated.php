<?php

declare(strict_types=1);

namespace App\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

use DateTimeImmutable;
use InvalidArgumentException;

/**
 * Class DateCreated
 * @package App\Model\ValueObject
 * @ORM\Embeddable
 */
class DateCreated
{
    const MESSAGE_NOT_FUTURE_DATE = 'Дата не может быть в будущем';

    /**
     * @var DateTimeImmutable $value
     * @ORM\Column(type="date_immutable")
     */
    private DateTimeImmutable $value;

    /**
     * DateCreated constructor.
     * @param DateTimeImmutable $value
     */
    public function __construct(DateTimeImmutable $value)
    {
        $this->setValue($value);
    }

    /***/
    private function setValue(DateTimeImmutable $value): void
    {
        $this->assertDateNotInFuture($value);
        $this->value = $value;
    }

    /**
     * @return DateTimeImmutable
     */
    public function value(): DateTimeImmutable
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
        // Сравнение двух экземпляров одного и того же класса (без ссылок)
        return $this->value() instanceof DateTimeImmutable
            && $otherValue->value() instanceof DateTimeImmutable
            && $this->value() == $otherValue->value();
    }

    /**
     * Проверить, что дата не в будущем.
     * @param DateTimeImmutable $value
     */
    private function assertDateNotInFuture(DateTimeImmutable $value)
    {
        $today = new DateTimeImmutable();

        if ($value > $today) {
            throw new InvalidArgumentException(
                self::MESSAGE_NOT_FUTURE_DATE
            );
        }
    }
}
