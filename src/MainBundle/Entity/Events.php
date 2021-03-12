<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events", indexes={@ORM\Index(name="nom_org", columns={"nom_org"})})
 * @ORM\Entity
 */
class Events
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEv;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_org", type="string", length=50, nullable=false)
     */
    private $nomOrg;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_event", type="string", length=50, nullable=false)
     */
    private $nomEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=50, nullable=false)
     */
    private $lieu;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_place", type="integer", nullable=false)
     */
    private $nbPlace;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dt_event", type="date", nullable=false)
     */
    private $dtEvent;

    /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=50, nullable=false)
     */
    private $etat;



    /**
     * Get idEv
     *
     * @return integer
     */
    public function getIdEv()
    {
        return $this->idEv;
    }

    /**
     * Set nomOrg
     *
     * @param string $nomOrg
     *
     * @return Events
     */
    public function setNomOrg($nomOrg)
    {
        $this->nomOrg = $nomOrg;

        return $this;
    }

    /**
     * Get nomOrg
     *
     * @return string
     */
    public function getNomOrg()
    {
        return $this->nomOrg;
    }

    /**
     * Set nomEvent
     *
     * @param string $nomEvent
     *
     * @return Events
     */
    public function setNomEvent($nomEvent)
    {
        $this->nomEvent = $nomEvent;

        return $this;
    }

    /**
     * Get nomEvent
     *
     * @return string
     */
    public function getNomEvent()
    {
        return $this->nomEvent;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Events
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
     * Set nbPlace
     *
     * @param integer $nbPlace
     *
     * @return Events
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;

        return $this;
    }

    /**
     * Get nbPlace
     *
     * @return integer
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * Set dtEvent
     *
     * @param \DateTime $dtEvent
     *
     * @return Events
     */
    public function setDtEvent($dtEvent)
    {
        $this->dtEvent = $dtEvent;

        return $this;
    }

    /**
     * Get dtEvent
     *
     * @return \DateTime
     */
    public function getDtEvent()
    {
        return $this->dtEvent;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Events
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Events
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Events
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
