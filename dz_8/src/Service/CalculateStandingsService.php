<?php


namespace App\Service;


use App\Entity\Match\Match;
use Doctrine\ORM\EntityManagerInterface;

class CalculateStandingsService
{
    public function calculateStandings(EntityManagerInterface $entityManager, CreateMatchService $calculate){
        $matches = $entityManager->getRepository(Match::class)->findBy(["status"=>9]);

        /* @var $match Match */
        foreach($matches as $match){
            $calculate->calculateStanding($entityManager, $match);
        }
    }
}