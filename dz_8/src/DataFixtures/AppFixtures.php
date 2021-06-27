<?php

namespace App\DataFixtures;

use App\Entity\Category\Category;
use App\Entity\Competition\Competition;
use App\Entity\Competitor\Competitor;
use App\Entity\Country\Country;
use App\Entity\Season\Season;
use App\Entity\Standings\Standings;
use App\Entity\StandingsRow\StandingsRow;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Sport\Sport;
use Exception;

class AppFixtures extends Fixture
{

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function load(ObjectManager $manager)
    {
        #creating football and basketball
        $sport1 = new Sport();
        $sport1->setName("football");
        $sport1->setSlug(slugify("football"));
        $sport2 = new Sport();
        $sport2->setName("basketball");
        $sport2->setSlug(slugify("basketball"));
        $sports = [$sport1, $sport2];

        $sport = $sports[array_rand($sports)];

        #creating category for randomly chosen sport
        $name = randName();
        $category = new Category();
        $category->setName($name);
        $category->setSlug(slugify($name));
        $category->setSport($sport);

        #creating competition
        $rounds = [2, 4];
        $round = $rounds[array_rand($rounds)];
        $competition = new Competition();
        $competition->setName(randName());
        $competition->setSlug(slugify($name));
        $competition->setRounds($round);
        $competition->setCategory($category);

        #creating season
        $time = mt_rand(1262347200,2524651200);     #time in [2010-01-01 12:00:00, 2050-01-01 12:00:00]
        $duration = mt_rand(18316800, 28857600);    #season duration [7 months, 11 months]
        $season = new Season();
        $season->setName(randName());
        $season->setCompetition($competition);
        $season->setStartDate(DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s", $time)));
        $season->setEndDate(DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s", $time+$duration)));

        #creating country
        $country1 = new Country();
        $country1->setIsoAlpha2("HR");
        $country2 = new Country();
        $country2->setIsoAlpha2("DE");
        $countries = [$country1, $country2];

        $type = [1, 2, 3];
        $teams = array();

        #creating 10 competitors
        for($i = 0; $i < 10; $i++){
            $name = randName();
            $team = new Competitor();
            $team->setName($name);
            $team->setSlug(slugify($name));
            $team->setCountry($countries[array_rand($countries)]);
            $team->setType($type[array_rand($type)]);
            $team->setSport($sport);
            $teams[] = $team;

            $manager->persist($team);
        }

        #creating standings HOME AWAY OVERALL
        $standingsHome = new Standings();
        $standingsHome->setType("HOME");
        $standingsHome->setSeason($season);

        $standingsAway = new Standings();
        $standingsAway->setType("AWAY");
        $standingsAway->setSeason($season);

        $standingsOverall = new Standings();
        $standingsOverall->setType("OVERALL");
        $standingsOverall->setSeason($season);

        $standings = [$standingsHome, $standingsAway, $standingsOverall];

        #creating standings rows
        foreach ($teams as $team){
            foreach ($standings as $st) {
                $sRow = new StandingsRow();
                $sRow->setCompetitor($team);
                $sRow->setStandings($st);
                $sRow->setMatches(0);
                $sRow->setWins(0);
                $sRow->setLoses(0);
                $sRow->setScoresAgainst(0);
                $sRow->setScoresFor(0);

                if (($team->getSport())->getName() == "football") {
                    $sRow->setDraws(0);
                    $sRow->setPoints(0);
                } else {
                    $sRow->setPercentage(0);
                }
                $manager->persist($sRow);
            }
        }

        $manager->persist($sport1);
        $manager->persist($sport2);
        $manager->persist($category);
        $manager->persist($competition);
        $manager->persist($season);
        $manager->persist($standingsHome);
        $manager->persist($standingsAway);
        $manager->persist($standingsOverall);
        $manager->flush();
    }
}