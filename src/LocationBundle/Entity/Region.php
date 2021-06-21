<?php


namespace LocationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Region
 *
 * @ORM\Table(name="Region")
 * @ORM\Entity(repositoryClass="LocationBundle\Repository\regionRepository")
 */
class Region
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_reg", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id_reg;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @return int
     */
    public function getIdReg()
    {
        return $this->id_reg;
    }

    /**
     * @param int $id_reg
     */
    public function setIdReg($id_reg)
    {
        $this->id_reg = $id_reg;
    }




    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Region
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }


}