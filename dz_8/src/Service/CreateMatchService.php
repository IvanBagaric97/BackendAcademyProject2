<?php


namespace App\Service;


use App\Entity\Match\Match;
use App\Entity\Score\BasketballScore;
use App\Entity\Score\FootballScore;
use App\Entity\Standings\Standings;
use App\Entity\StandingsRow\StandingsRow;
use Doctrine\ORM\EntityManagerInterface;

class CreateMatchService
{
    public function createMatch(EntityManagerInterface $entityManager) : void
    {
        $matches = $entityManager->getRepository(Match::class)->findAll();

        usort($matches, "self::cmp");

        $match = self::getFirstMatch($matches);
        $sport = (($match->getHomeCompetitor())->getSport())->getName();

        $match->setStatus('finished');
        if($sport == "football"){
            $homeScore = new FootballScore();
            $awayScore = new FootballScore();

            foreach ([$homeScore, $awayScore] as $score) {
                $score->setHalftime(self::getRandScore("football"));
                $score->setFinal(self::getRandScore("football") + $homeScore->getHalftime());
            }
            if($homeScore->getFinal() > $awayScore->getFinal()){
                $match->setWinner(1);
            }elseif($homeScore->getFinal() < $awayScore->getFinal()) {
                $match->setWinner(2);
            }elseif($homeScore->getFinal() == $awayScore->getFinal()){
                $match->setWinner(3);
            }
        }else {
            $homeScore = new BasketballScore();
            $awayScore = new BasketballScore();

            foreach ([$homeScore, $awayScore] as $score) {
                $score->setPeriod1(self::getRandScore("basketball"));
                $score->setPeriod2(self::getRandScore("basketball") + $homeScore->getPeriod1());
                $score->setPeriod3(self::getRandScore("basketball") + $homeScore->getPeriod1() + $homeScore->getPeriod2());
                $score->setPeriod4(self::getRandScore("basketball") + $homeScore->getPeriod1() + $homeScore->getPeriod2() + $homeScore->getPeriod3());
            }
            if($homeScore->getPeriod4() > $awayScore->getPeriod4()){
                $match->setWinner(1);
            }elseif($homeScore->getPeriod4() < $awayScore->getPeriod4()){
                $match->setWinner(2);
            }elseif($homeScore->getPeriod4() == $awayScore->getPeriod4()){
                $homeScore->setOvertime(self::getRandScore("basketball"));
                $awayScore->setOvertime(self::getRandScore("basketball"));

                if($homeScore->getOvertime() > $awayScore->getOvertime()){
                    $match->setWinner(1);
                }elseif($homeScore->getOvertime() < $awayScore->getOvertime()) {
                    $match->setWinner(2);
                }elseif($homeScore->getOvertime() == $awayScore->getOvertime()){
                    $match->setWinner(3);
                }
            }
        }
        $match->setHomeScore($homeScore);
        $match->setAwayScore($awayScore);

        $entityManager->persist($match);
        $entityManager->flush();

        self::calculateStanding($entityManager, $match);
    }

    public function calculateStanding(EntityManagerInterface $entityManager, Match $match): void
    {
        $sport = (($match->getHomeCompetitor())->getSport())->getName();
        $homeStanding = $entityManager->getRepository(Standings::class)->findBy(['type'=>'HOME']);
        $awayStanding = $entityManager->getRepository(Standings::class)->findBy(['type'=>'AWAY']);
        $overallStanding = $entityManager->getRepository(Standings::class)->findBy(['type'=>'OVERALL']);

        /** @var $standing1 StandingsRow */
        $standing1 = $entityManager->getRepository(StandingsRow::class)->findBy(['competitor' => $match->getHomeCompetitor(), 'standings' => $homeStanding])[0];
        /** @var $standing2 StandingsRow */
        $standing2 = $entityManager->getRepository(StandingsRow::class)->findBy(['competitor' => $match->getAwayCompetitor(), 'standings' => $awayStanding])[0];

        $standings = self::createStanding($sport, $standing1, $standing2, $match);
        $standing1 = $standings[0];
        $standing2 = $standings[1];

        $entityManager->persist($standing1);
        $entityManager->persist($standing2);
        $entityManager->flush();

        /** @var $standing1 StandingsRow */
        $standing1 = $entityManager->getRepository(StandingsRow::class)->findBy(['competitor' => $match->getHomeCompetitor(), 'standings' => $overallStanding])[0];

        /** @var $standing2 StandingsRow */
        $standing2 = $entityManager->getRepository(StandingsRow::class)->findBy(['competitor' => $match->getAwayCompetitor(), 'standings' => $overallStanding])[0];

        $standings = self::createStanding($sport, $standing1, $standing2, $match);
        $standing1 = $standings[0];
        $standing2 = $standings[1];

        $entityManager->persist($standing1);
        $entityManager->persist($standing2);
        $entityManager->flush();
    }

    protected function createStanding($sport, $standing1, $standing2, $match): array
    {
        $standing1->setMatches($standing1->getMatches() + 1);
        $standing2->setMatches($standing1->getMatches() + 1);

        if($match->getWinner() == 1){
            $standing1->setWins($standing1->getWins() + 1);
            $standing2->setLoses($standing2->getLoses() + 1);

            if($sport == "football") $standing1->setPoints($standing1->getPoints() + 3);

        }elseif($match->getWinner() == 2){
            $standing1->setLoses($standing1->getLoses() + 1);
            $standing2->setWins($standing2->getWins() + 1);

            if($sport == "football") $standing2->setPoints($standing2->getPoints() + 3);
        }

        if($sport == "football"){
            $standing1->setScoresAgainst(($match->getAwayScore())->getFinal());
            $standing1->setScoresFor(($match->getHomeScore())->getFinal());

            $standing2->setScoresAgainst(($match->getHomeScore())->getFinal());
            $standing2->setScoresFor(($match->getAwayScore())->getFinal());

            if(($match->getHomeScore())->getFinal() == ($match->getAwayScore())->getFinal()){
                $standing1->setDraws($standing1->getDraws() + 1);
            }
        }else{
            $standing1->setScoresAgainst(($match->getAwayScore())->getPeriod4());
            $standing1->setScoresFor(($match->getHomeScore())->getPeriod4());

            $standing2->setScoresAgainst(($match->getHomeScore())->getPeriod4());
            $standing2->setScoresFor(($match->getAwayScore())->getPeriod4());

            $standing1->setPercentage(100 * $standing1->getWins()/($standing1->getLoses() + $standing1->getWins()));
            $standing2->setPercentage(100 * $standing2->getWins()/($standing2->getLoses() + $standing2->getWins()));
        }

        return [$standing1, $standing2];
    }

    protected function cmp($a, $b): bool
    {
        return $a->getStart() > $b->getStart();
    }

    protected function getRandScore(string $sport): int
    {
        if($sport == "football"){
            $score = rand(0, 4);
        }else{
            $score = rand(15, 30);
        }
        return $score;
    }

    protected function getFirstMatch(array $matches): ?Match
    {
        foreach ($matches as $match){
            if($match->getStatus() == 0){
                return $match;
            }
        }
        return null;
    }
}