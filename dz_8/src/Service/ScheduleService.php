<?php

namespace App\Service;

use App\Entity\Match\Basketball;
use App\Entity\Match\Football;
use App\Entity\Score\BasketballScore;
use App\Entity\Score\FootballScore;
use App\Entity\Standings\Standings;
use App\Entity\StandingsRow\StandingsRow;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ScheduleService
{

    public function scheduleMatches(EntityManagerInterface $entityManager){

        $standings = $entityManager->getRepository(Standings::class)->findBy(['type' => 'HOME']);
        $standings = $entityManager->getRepository(StandingsRow::class)->findBy(['standings' => $standings]);

        $rounds = ((($standings[0]->getStandings())->getSeason())->getCompetition())->getRounds();
        $seasonStart = (($standings[0]->getStandings())->getSeason())->getStartDate();
        $seasonEnd = (($standings[0]->getStandings())->getSeason())->getEndDate();
        $sport = ($standings[0]->getCompetitor())->getSport();
        $homeRounds = $rounds / 2;
        $matchDates = array();

        foreach ($standings as $standing){
            foreach ($standings as $stan) {
                if(($standing->getCompetitor())->getName() == ($stan->getCompetitor())->getName()) continue;
                for($i = 0; $i < $homeRounds; $i++) {
                    if ($sport->getName() == "football") {
                        $match = new Football();
                        $homeScore = new FootballScore();
                        $awayScore = new FootballScore();
                    } else {
                        $match = new Basketball();
                        $homeScore = new BasketballScore();
                        $awayScore = new BasketballScore();
                    }
                    $date = self::getMatchDate($seasonStart, $seasonEnd, $matchDates, ($standing->getCompetitor())->getName(), ($stan->getCompetitor())->getName());
                    $match->setHomeCompetitor($standing->getCompetitor());
                    $match->setAwayCompetitor($stan->getCompetitor());
                    $match->setStart($date);
                    $match->setStatus('not_started');
                    $match->setCompetition((($standing->getStandings())->getSeason())->getCompetition());
                    $match->setSeason(($standing->getStandings())->getSeason());
                    $match->setHomeScore($homeScore);
                    $match->setAwayScore($awayScore);

                    $entityManager->persist($match);
                    $entityManager->flush();

                    $matchDates[($match->getHomeCompetitor())->getName()][] = $date;
                    $matchDates[($match->getAwayCompetitor())->getName()][] = $date;
                }
            }
        }

    }

    private function getMatchDate(DateTime $seasonStart, DateTime $seasonEnd, array $matchDates, string $homeComp, string $awayComp) : DateTime
    {
        if(count($matchDates) == 0){
            return $seasonStart;

        }elseif(count($matchDates) == 1){
            return $seasonEnd;

        }else{

            if(isset($matchDates[$homeComp]) and isset($matchDates[$awayComp])) {
                $x = $matchDates[$homeComp];
                $y = $matchDates[$awayComp];

                while (True) {
                    $matchDate = DateTime::createFromFormat('Y-m-d H:i:s',
                        self::randomDate($seasonStart->format('Y-m-d H:i:s'), $seasonEnd->format('Y-m-d H:i:s')));
                    if(self::checkTimeLimit($x, $matchDate) and self::checkTimeLimit($y, $matchDate)){
                        return $matchDate;
                    }
                }
            }else{
                return DateTime::createFromFormat('Y-m-d H:i:s',
                    self::randomDate($seasonStart->format('Y-m-d H:i:s'), $seasonEnd->format('Y-m-d H:i:s')));
            }
        }
    }

    function randomDate($sStartDate, $sEndDate, $sFormat = 'Y-m-d H:i:s')
    {
        // Convert the supplied date to timestamp
        $fMin = strtotime($sStartDate);
        $fMax = strtotime($sEndDate);

        // Generate a random number from the start and end dates
        $fVal = mt_rand($fMin, $fMax);

        // Convert back to the specified date format
        return date($sFormat, $fVal);
    }

    function checkTimeLimit($x, $matchDate): bool
    {
        $flag = False;
        foreach ($x as $date) {
            $h = ($date->diff($matchDate));
            $h = intval($h->format('%a')) * 24 + intval($h->format('%H'));
            if ($h < 12) {
                return False;
            } else {
                $flag = True;
            }
        }
        if($flag) return True;
    }
}