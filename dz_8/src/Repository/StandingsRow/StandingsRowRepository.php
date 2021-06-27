<?php


namespace App\Repository\StandingsRow;

use App\Entity\StandingsRow\StandingsRow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StandingsRowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StandingsRow::class);
    }
}