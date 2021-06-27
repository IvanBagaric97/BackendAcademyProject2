<?php


namespace App\Entity\Country;

use App\Service\Helper\CountryHelper;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Country
 * @ORM\Embeddable()
 * @package App\Entity\Country
 */
class Country
{

    /**
     * @ORM\Column(type="string", nullable=true, length=2)
     * @var string|null
     */
    protected ?string $isoAlpha2;

    /**
     * @return string|null
     */
    public function getIsoAlpha2(): ?string
    {
        return $this->isoAlpha2;
    }

    /**
     * @param string|null $isoAlpha2
     */
    public function setIsoAlpha2(?string $isoAlpha2): void
    {
        $this->isoAlpha2 = $isoAlpha2;
    }

    public function getName(): ?string
    {
        return CountryHelper::getName($this->isoAlpha2);
    }

}
