<?php


namespace App\Entity\Standings;

use \App\Entity\AbstractPrimaryEntity;
use App\Entity\Season\Season;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Season
 * @ORM\Entity(repositoryClass="App\Repository\Standings\StandingsRepository")
 * @package App\Entity\Standings
 */
class Standings extends AbstractPrimaryEntity
{
    /**
     * @ORM\ManyToOne(targetEntity=Season::class)
     * @var Season
     */
    protected Season $season;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $type;

    /**
     * @return Season
     */
    public function getSeason(): Season
    {
        return $this->season;
    }

    /**
     * @param Season $season
     */
    public function setSeason(Season $season): void
    {
        $this->season = $season;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}