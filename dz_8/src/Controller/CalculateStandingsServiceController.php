<?php


namespace App\Controller;

use App\Service\CalculateStandingsService;
use App\Service\CreateMatchService;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculateStandingsServiceController extends AbstractController
{
    /**
     * @Route("/calculate-standings")
     */
    public function calculateStandings(EntityManagerInterface $entityManager, CalculateStandingsService $service,
                                       CreateMatchService $calc): Response{

        $c = new CalculateStandingsService();
        $c->calculateStandings($entityManager, $calc);
        return new Response("Standings for all finished matcher are calculated, to see list of standings rows go to /test/standings-rows");
    }
}