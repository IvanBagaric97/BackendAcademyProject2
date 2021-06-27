<?php


namespace App\Entity\Score;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class FootballScore
 * @ORM\Embeddable()
 * @package App\Entity\Score
 */
class BasketballScore
{
    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    protected ?int $period1;

    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    protected ?int $period2;

    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    protected ?int $period3;

    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    protected ?int $period4;

    /**
     * @ORM\Column(type="integer")
     * @var int|null
     */
    protected ?int $overtime;

    /**
     * @return int|null
     */
    public function getOvertime(): ?int
    {
        return $this->overtime;
    }

    /**
     * @param int|null $overtime
     */
    public function setOvertime(?int $overtime): void
    {
        $this->overtime = $overtime;
    }

    /**
     * @return int|null
     */
    public function getPeriod1(): ?int
    {
        return $this->period1;
    }

    /**
     * @param int|null $period1
     */
    public function setPeriod1(?int $period1): void
    {
        $this->period1 = $period1;
    }

    /**
     * @return int|null
     */
    public function getPeriod2(): ?int
    {
        return $this->period2;
    }

    /**
     * @param int|null $period2
     */
    public function setPeriod2(?int $period2): void
    {
        $this->period2 = $period2;
    }

    /**
     * @return int|null
     */
    public function getPeriod3(): ?int
    {
        return $this->period3;
    }

    /**
     * @param int|null $period3
     */
    public function setPeriod3(?int $period3): void
    {
        $this->period3 = $period3;
    }

    /**
     * @return int|null
     */
    public function getPeriod4(): ?int
    {
        return $this->period4;
    }

    /**
     * @param int|null $period4
     */
    public function setPeriod4(?int $period4): void
    {
        $this->period4 = $period4;
    }
}