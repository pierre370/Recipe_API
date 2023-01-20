<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 *@ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
#[ApiResource]

class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups("user:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"user:read", "user:write"})
     * @Groups("user:read")
     */
    private $tokenId;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:write"})
     * @Groups("user:read")
     */
    private $userId;
    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="recipes")
     */
    private $User;

    public function __construct()
    {
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTokenId(): ?string
    {
        return $this->tokenId;
    }

    public function setTokenId(string $tokenId): self
    {
        $this->tokenId = $tokenId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(User $user): self
    {
        if (!$this->User->contains($user)) {
            $this->User[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->User->removeElement($user);

        return $this;
    }
}
