<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="id_ev", columns={"id_ev"}), @ORM\Index(name="id_par", columns={"id_par"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_ticket", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTicket;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ev", type="integer", nullable=false)
     */
    private $idEv;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_par", type="integer", nullable=false)
     */
    private $idPar;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=false)
     */
    private $image;



    /**
     * Get idTicket
     *
     * @return integer
     */
    public function getIdTicket()
    {
        return $this->idTicket;
    }

    /**
     * Set idEv
     *
     * @param integer $idEv
     *
     * @return Reservation
     */
    public function setIdEv($idEv)
    {
        $this->idEv = $idEv;

        return $this;
    }

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
     * Set idPar
     *
     * @param integer $idPar
     *
     * @return Reservation
     */
    public function setIdPar($idPar)
    {
        $this->idPar = $idPar;

        return $this;
    }

    /**
     * Get idPar
     *
     * @return integer
     */
    public function getIdPar()
    {
        return $this->idPar;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Reservation
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

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Reservation
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Reservation
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
