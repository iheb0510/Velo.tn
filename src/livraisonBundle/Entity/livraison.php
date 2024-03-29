<?php

namespace livraisonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * livraison
 *
 * @ORM\Table(name="livraison")
 * @ORM\Entity(repositoryClass="livraisonBundle\Repository\livraisonRepository")
 */
class livraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datelivraison", type="date")
     */
    private $datelivraison;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="etatlivraison", type="string", length=255)
     */
    private $etatlivraison;

    /**
     * @ORM\ManyToOne(targetEntity="livraisonBundle\Entity\transporteur",inversedBy="livraison")
     * @ORM\JoinColumn(name="transporteur",referencedColumnName="id")
     */
    private $transporteur;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return livraison
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set datelivraison
     *
     * @param \DateTime $datelivraison
     *
     * @return livraison
     */
    public function setDatelivraison($datelivraison)
    {
        $this->datelivraison = $datelivraison;

        return $this;
    }

    /**
     * Get datelivraison
     *
     * @return \DateTime
     */
    public function getDatelivraison()
    {
        return $this->datelivraison;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return livraison
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set etatlivraison
     *
     * @param string $etatlivraison
     *
     * @return livraison
     */
    public function setEtatlivraison($etatlivraison)
    {
        $this->etatlivraison = $etatlivraison;

        return $this;
    }

    /**
     * Get etatlivraison
     *
     * @return string
     */
    public function getEtatlivraison()
    {
        return $this->etatlivraison;
    }

    /**
     * Set transporteur
     *
     * @param \livraisonBundle\Entity\Ptransporteur $transporteur
     *
     * @return livraison
     */
    public function setTransporteur(\livraisonBundle\Entity\Ptransporteur $transporteur = null)
    {
        $this->transporteur = $transporteur;

        return $this;
    }

    /**
     * Get transporteur
     *
     * @return \livraisonBundle\Entity\Ptransporteur
     */
    public function getTransporteur()
    {
        return $this->transporteur;
    }
}
