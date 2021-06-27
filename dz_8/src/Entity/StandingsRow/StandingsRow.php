<?php


namespace App\Entity\StandingsRow;


use App\Entity\AbstractPrimaryEntity;
use App\Entity\Competitor\Competitor;
use App\Entity\Standings\Standings;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class StandingsRow
 * @ORM\Entity(repositoryClass="App\Repository\StandingsRow\StandingsRowRepository")
 * @package App\Entity\StandingsRow
 */
class StandingsRow extends AbstractPrimaryEntity
{
    /**
     * @ORM\ManyToOne(targetEntity=Competitor::class)
     * @Groups({"common"})
     * @var Competitor
     */
    protected Competitor $competitor;

    /**
     * @ORM\ManyToOne(targetEntity=Standings::class)
     * @var Standings
     */
    protected Standings $standings;

    /**
     * @ORM\Column(type="integer")
     * * @Groups({"common", "row_full"})
     * @var int
     */
    protected int $matches;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $wins;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $loses;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $scoresAgainst;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $scoresFor;

    /**
     * @ORM\Column(type="integer", nullable=True)
     * @var int|null
     */
    protected ?int $draws;

    /**
     * @ORM\Column(type="integer", nullable=True)
     * @var int|null
     */
    protected ?int $points;

    /**
     * @ORM\Column(type="integer", nullable=True)
     * @var int|null
     */
    protected ?int $percentage;

    /**
     * @return Competitor
     */
    public function getCompetitor(): Competitor
    {
        return $this->competitor;
    }

    /**
     * @param Competitor $competitor
     */
    public function setCompetitor(Competitor $competitor): void
    {
        $this->competitor = $competitor;
    }

    /**
     * @return Standings
     */
    public function getStandings(): Standings
    {
        return $this->standings;
    }

    /**
     * @param Standings $standings
     */
    public function setStandings(Standings $standings): void
    {
        $this->standings = $standings;
    }

    /**
     * @return int
     */
    public function getMatches(): int
    {
        return $this->matches;
    }

    /**
     * @param int $matches
     */
    public function setMatches(int $matches): void
    {
        $this->matches = $matches;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    public function setWins(int $wins): void
    {
        $this->wins = $wins;
    }

    /**
     * @return int
     */
    public function getLoses(): int
    {
        return $this->loses;
    }

    /**
     * @param int $loses
     */
    public function setLoses(int $loses): void
    {
        $this->loses = $loses;
    }

    /**
     * @return int
     */
    public function getScoresAgainst(): int
    {
        return $this->scoresAgainst;
    }

    /**
     * @param int $scoresAgainst
     */
    public function setScoresAgainst(int $scoresAgainst): void
    {
        $this->scoresAgainst = $scoresAgainst;
    }

    /**
     * @return int
     */
    public function getScoresFor(): int
    {
        return $this->scoresFor;
    }

    /**
     * @param int $scoresFor
     */
    public function setScoresFor(int $scoresFor): void
    {
        $this->scoresFor = $scoresFor;
    }

    /**
     * @return int|null
     */
    public function getDraws(): ?int
    {
        return $this->draws;
    }

    /**
     * @param int|null $draws
     */
    public function setDraws(?int $draws): void
    {
        $this->draws = $draws;
    }

    /**
     * @return int|null
     */
    public function getPoints(): ?int
    {
        return $this->points;
    }

    /**
     * @param int|null $points
     */
    public function setPoints(?int $points): void
    {
        $this->points = $points;
    }

    /**
     * @return int|null
     */
    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    /**
     * @param int|null $percentage
     */
    public function setPercentage(?int $percentage): void
    {
        $this->percentage = $percentage;
    }
}