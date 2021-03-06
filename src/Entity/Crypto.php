<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\CryptoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CryptoRepository::class)
 */
class Crypto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $symbole;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @Assert\Type(type="integer")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbLikes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="cryptos")
     */
    private $createur;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="cryptosFavoris")
     */
    private $fans;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="cryptocurrency")
     */
    private $comments;

     /* @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $dateMaj;

    /**
     * @Assert\Type(type="integer")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantiteMax;

    public function __construct()
    {
        $this->fans = new ArrayCollection();
        $this->date = new \DateTime();
        $this->comments = new ArrayCollection();
        $this->dateMaj = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSymbole(): ?string
    {
        return $this->symbole;
    }

    public function setSymbole(?string $symbole): self
    {
        $this->symbole = $symbole;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbLikes(): ?int
    {
        return $this->nbLikes;
    }

    public function setNbLikes(?int $nbLikes): self
    {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): self
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFans(): Collection
    {
        return $this->fans;
    }

    public function addFan(User $fan): self
    {
        if (!$this->fans->contains($fan)) {
            $this->fans[] = $fan;
        }

        return $this;
    }

    public function removeFan(User $fan): self
    {
        $this->fans->removeElement($fan);

        return $this;
    }

    public function __toString()
    {
        return (string) $this->getCreateur();
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setCryptocurrency($this);
        }
        return $this;
    }
    public function getDateMaj(): ?\DateTimeInterface
    {
        return $this->dateMaj;
    }

    public function setDateMaj(\DateTimeInterface $dateMaj): self
    {
        $this->dateMaj = $dateMaj;

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getCryptocurrency() === $this) {
                $comment->setCryptocurrency(null);
            }
        }
    }
    public function getQuantiteMax(): ?int
    {
        return $this->quantiteMax;
    }

    public function setQuantiteMax(?int $quantiteMax): self
    {
        $this->quantiteMax = $quantiteMax;

        return $this;
    }
}
