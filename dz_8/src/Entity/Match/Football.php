<?php


namespace App\Entity\Match;

use App\Entity\Score\FootballScore;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Football
 * @ORM\Entity()
 * @package App\Entity\Match
 */
class Football extends Match
{
    /**
     * @ORM\Embedded(class="App\Entity\Score\FootballScore")
     * @var FootballScore
     */
    protected FootballScore $homeScore;

    /**
     * @ORM\Embedded(class="App\Entity\Score\FootballScore")
     * @var FootballScore
     */
    protected FootballScore $awayScore;

    /**
     * @return FootballScore
     */
    public function getHomeScore(): FootballScore
    {
        return $this->homeScore;
    }

    /**
     * @param FootballScore $homeScore
     */
    public function setHomeScore(FootballScore $homeScore): void
    {
        $this->homeScore = $homeScore;
    }

    /**
     * @return FootballScore
     */
    public function getAwayScore(): FootballScore
    {
        return $this->awayScore;
    }

    /**
     * @param FootballScore $awayScore
     */
    public function setAwayScore(FootballScore $awayScore): void
    {
        $this->awayScore = $awayScore;
    }
}
