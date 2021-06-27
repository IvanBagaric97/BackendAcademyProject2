<?php


namespace App\Controller;


use App\Entity\Category\Category;
use App\Entity\Competition\Competition;
use App\Entity\Competitor\Competitor;
use App\Entity\Match\Match;
use App\Entity\Season\Season;
use App\Entity\Sport\Sport;
use App\Entity\Standings\Standings;
use App\Entity\StandingsRow\StandingsRow;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TestController
 * @Route("/test")
 *
 * @package App\Controller
 */
class TestController extends AbstractController
{
    /**
     * @Route("/sport")
     */
    public function testSport(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Sport::class)->findAll();
        $rez = "NAME:  SLUG:<br>";
        foreach ($var as $s){
            $rez .= $s->getName() . "-" . $s->getSlug() . "<br>";
        }

        return new Response($rez);
    }

    /**
     * @Route("/category")
     */
    public function testCategory(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Category::class)->findAll();
        $rez = "NAME:  SLUG:  SPORT_NAME:<br>";
        foreach ($var as $s){
            $rez .= $s->getName() . "-" . $s->getSlug() . "-" . ($s->getSport())->getName() . "<br>";
        }

        return new Response($rez);
    }

    /**
     * @Route("/competition")
     */
    public function testCompetition(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Competition::class)->findAll();
        $rez = "NAME:  SLUG:  ROUNDS:  CATEGORY_NAME:<br>";
        foreach ($var as $s){
            $rez .= $s->getName() . "-" . $s->getSlug() . "-" . $s->getRounds() . "-" . ($s->getCategory())->getName() . "<br>";
        }

        return new Response($rez);
    }

    /**
     * @Route("/competitor")
     */
    public function testCompetitor(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Competitor::class)->findAll();
        $rez = "NAME:  SLUG:  TYPE:  SPORT_NAME:  COUNTRY_NAME:<br>";
        foreach ($var as $s){
            $rez .= $s->getName() . "-" . $s->getSlug() . "-" . $s->getType() . "-" . ($s->getSport())->getName() . "-" . ($s->getCountry())->getName() . "<br>";
        }

        return new Response($rez);
    }

    /**
     * @Route("/season")
     */
    public function testSeason(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Season::class)->findAll();
        $rez = "NAME:  COMPETITION_NAME:  START_DATE:  END_DATE:<br>";
        foreach ($var as $s){
            $rez .= $s->getName() . "-" . ($s->getCompetition())->getName() . "-" .
                ($s->getStartDate())->format('Y-m-d H:i:s') . "-" . ($s->getEndDate())->format('Y-m-d H:i:s') . "<br>";
        }

        return new Response($rez);
    }

    /**
     * @Route("/standings")
     */
    public function testStandings(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Standings::class)->findAll();
        $rez = "SEASON_NAME:  TYPE:<br>";
        foreach ($var as $s){
            $rez .= ($s->getSeason())->getName() . "-" . $s->getType() . "<br>";
        }

        return new Response($rez);
    }

    /**
     * @Route("/standings-row")
     */
    public function testStandingsRow(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(StandingsRow::class)->findAll();
        $rez = "ID: C_NAME:  SEASON:  S_TYPE:  MATCHES:  WINS:  LOSES:  S_AGAINST: S_FOR:  DRAWS:  POINTS:  PERCENTAGE:<br>";
        foreach ($var as $s){
            $rez .= $s->getId() . "-". ($s->getCompetitor())->getName() . "-" . (($s->getStandings())->getSeason())->getName() . "-" . ($s->getStandings())->getType()
                . "-" . $s->getMatches() . "-" . $s->getWins() . "-" . $s->getLoses() . "-" . $s->getScoresAgainst() . "-"
                . $s->getScoresFor() . "-" . $s->getDraws() . "-" . $s->getPoints() . "-" . $s->getPercentage() . "<br>";
        }

        return new Response($rez);
    }

    /**
     * @Route("/matches")
     */
    public function testMatches(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Match::class)->findAll();
        $rez = "HOME_C:  AWAY_C:  START_D:  STATUS:  COMP:  SEASON:  WINNER: <br>";
        foreach ($var as $s){
            $rez .= ($s->getHomeCompetitor())->getName() . "-" . ($s->getAwayCompetitor())->getName() . "-"
                . ($s->getStart())->format('Y-m-d H:i:s'). "-" . $s->getStatus() . "-" . ($s->getCompetition())->getName()
                . "-" . ($s->getSeason())->getName(). "-" . $s->getWinner() . "<br>";
        }
        return new Response($rez);
    }

    /**
     * @Route("/match-scores")
     */
    public function testMatchScores(EntityManagerInterface $entityManager): Response
    {
        $var = $entityManager->getRepository(Match::class)->findBy(["status"=>9]);
        $rez = "HOME_C:  AWAY_C: HOME_S: AWAY_S: WINNER: <br>";

        foreach ($var as $s){
            if((($s->getHomeCompetitor())->getSport())->getName() == "football"){
                $rez .= ($s->getHomeCompetitor())->getName() . "-" . ($s->getAwayCompetitor())->getName() .
                "-" . ($s->getHomeScore())->getFinal() . "-" . ($s->getAwayScore())->getFinal() . "-" .
                $s->getWinner() . "<br>";
            }else{
                $rez .= ($s->getHomeCompetitor())->getName() . "-" . ($s->getAwayCompetitor())->getName() .
                    "-" . ($s->getHomeScore())->getPeriod4() . "-" . ($s->getAwayScore())->getPeriod4() . "-" .
                    $s->getWinner() . "<br>";
            }
        }
        return new Response($rez);
    }
}