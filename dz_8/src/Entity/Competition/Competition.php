<?php


namespace App\Entity\Competition;

use \App\Entity\AbstractPrimaryEntity;
use App\Entity\Category\Category;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Competition
 * @ORM\Entity(repositoryClass="App\Repository\Competition\CompetitionRepository")
 * @package App\Entity\Competition
 */
class Competition extends AbstractPrimaryEntity
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
     * @ORM\OneToOne(targetEntity=Category::class)
     * @var Category
     */
    protected Category $category;

    /**
     * @ORM\Column(type="integer")
     * @var  int
     */
    protected int $rounds;

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
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getRounds(): int
    {
        return $this->rounds;
    }

    /**
     * @param int $rounds
     */
    public function setRounds(int $rounds): void
    {
        $this->rounds = $rounds;
    }
}