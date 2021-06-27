<?php


namespace App\Entity\Competitor;


use App\Entity\Sport\Sport;
use App\Entity\Country\Country;
use Doctrine\ORM\Mapping as ORM;
use \App\Entity\AbstractPrimaryEntity;

/**
 * Class Competitor
 * @ORM\Entity(repositoryClass="App\Repository\Competitor\CompetitorRepository")
 * @package App\Entity\Competitor
 */
class Competitor extends AbstractPrimaryEntity
{
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected string $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class)
     * @var Sport
     */
    protected Sport $sport;

    /**
     * @ORM\Embedded(class="App\Entity\Country\Country")
     * @var Country
     */
    protected Country $country;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected int $type;

    public function __construct()
    {
        $this->country = new Country();
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @return Sport
     */
    public function getSport(): Sport
    {
        return $this->sport;
    }

    /**
     * @param Sport $sport
     */
    public function setSport(Sport $sport): void
    {
        $this->sport = $sport;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }


}