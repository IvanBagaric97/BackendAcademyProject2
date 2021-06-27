<?php


namespace App\Controller;

use App\Service\CreateMatchService;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateMatchServiceController extends AbstractController
{
    /**
     * @Route("/create-match")
     */
    public function createMatches(CreateMatchService $match, EntityManagerInterface $entityManager): Response
    {
        $match->createMatch($entityManager);

        return new Response("Created new match, to see list of all matches visit /test/matches");
    }
}