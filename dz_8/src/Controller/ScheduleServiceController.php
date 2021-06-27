<?php

namespace App\Controller;

use App\Service\ScheduleService;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleServiceController extends AbstractController
{
    /**
     * @Route("/create-matches")
     */
    public function createMatches(ScheduleService $schedule, EntityManagerInterface $entityManager): Response
    {
        $schedule->scheduleMatches($entityManager);
        $rez = "Matches successfully created, to see list of matches visit /test/matches";

        return new Response($rez);
    }
}