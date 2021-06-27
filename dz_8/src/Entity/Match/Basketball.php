<?php


namespace App\Entity\Match;


use App\Entity\Score\BasketballScore;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Basketball
 * @ORM\Entity()
 * @package App\Entity\Match
 */
class Basketball extends Match
{
    /**
     * @ORM\Embedded(class="App\Entity\Score\BasketballScore")
     * @var BasketballScore
     */
    protected BasketballScore $homeScore;

    /**
     * @ORM\Embedded(class="App\Entity\Score\BasketballScore")
     * @var BasketballScore
     */
    protected BasketballScore $awayScore;

    /**
     * @return BasketballScore
     */
    public function getHomeScore(): BasketballScore
    {
        return $this->homeScore;
    }

    /**
     * @param BasketballScore $homeScore
     */
    public function setHomeScore(BasketballScore $homeScore): void
    {
        $this->homeScore = $homeScore;
    }

    /**
     * @return BasketballScore
     */
    public function getAwayScore(): BasketballScore
    {
        return $this->awayScore;
    }

    /**
     * @param BasketballScore $awayScore
     */
    public function setAwayScore(BasketballScore $awayScore): void
    {
        $this->awayScore = $awayScore;
    }
}
