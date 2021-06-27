<?php


namespace App\Entity\Category;

use \App\Entity\AbstractPrimaryEntity;
use App\Entity\Sport\Sport;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @ORM\Entity()
 * @package App\Entity\Category
 */
class Category extends AbstractPrimaryEntity
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

}
