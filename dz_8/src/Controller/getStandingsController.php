<?php


namespace App\Controller;

use App\Entity\StandingsRow\StandingsRow;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class getStandingsController extends AbstractController
{
    /**
     * @Route("/row/{id}")
     * @ParamConverter("row", class=StandingsRow::class , options={"id": "id"})
     * @Cache(smaxage="3789")
     */
    public function detailsAction(StandingsRow $row, EntityManagerInterface $entityManager, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse($serializer->serialize($row, 'json', ['groups' => 'common']),
            Response::HTTP_OK, [], true);
    }
}