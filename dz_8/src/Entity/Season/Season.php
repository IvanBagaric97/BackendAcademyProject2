<?php


namespace App\Entity\Season;

use \App\Entity\AbstractPrimaryEntity;
use App\Entity\Competition\Competition;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Season
 * @ORM\Entity(repositoryClass="App\Repository\Season\SeasonRepository")
 * @package App\Entity\Season
 */
class Season extends AbstractPrimaryEntity
{
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $name;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected DateTime $startDate;

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    protected DateTime $endDate;

    /**
     * @ORM\ManyToOne(targetEntity=Competition::class)
     * @var Competition
     */
    protected Competition $competition;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     */
    public function setEndDate(DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return Competition
     */
    public function getCompetition(): Competition
    {
        return $this->competition;
    }

    /**
     * @param Competition $competition
     */
    public function setCompetition(Competition $competition): void
    {
        $this->competition = $competition;
    }
}