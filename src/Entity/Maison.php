<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ORM\Entity(repositoryClass=MaisonRepository::class)
 * @Vich\Uploadable()
 */
class Maison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @var File
     * @Vich\UploadableField(mapping="property_image",fileNameProperty="filename")
     * @Orm\Column(type="string", length=200)
     */
    public $image;
    /**
     * @var string|null
     * @Orm\Column(type="string", length=100)
     */
    private $filename;

    /**
     * @ORM\Column(type="string", length=30)
     */

    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrechambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $etage;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $validation= false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $datecreationbien_at;

    public function __construct()
    {
        $this->datecreationbien_at = new \DateTime();
    }

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $adresse;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug()
    {
        return (new Slugify())->slugify($this->titre);
       //$slugify = new Slugify();
       //$slugify->slugify('Hello World!');

    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbrechambre(): ?int
    {
        return $this->nbrechambre;
    }

    public function setNbrechambre(?int $nbrechambre): self
    {
        $this->nbrechambre = $nbrechambre;

        return $this;
    }
    public function formateprix(): string
    {
     return number_forma($this->prix,0,'',' ');

    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getDatecreationbienAt(): ?\DateTimeInterface
    {
        return $this->datecreationbien_at;
    }

    public function setDatecreationbienAt(?\DateTimeInterface $datecreationbien_at): self
    {
        $this->datecreationbien_at = $datecreationbien_at;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     */
    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
    }


    /**
     * @param File $image
     */
    public function setImage(?File $image): self
    {
        $this->image = $image;
        if ($this->image instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }

              return $this;    
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    
}
