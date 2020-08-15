<?php

namespace App\Entity;

use App\Repository\DonateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DonateRepository::class)
 */
class Donate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom obligatoire.")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le om de famille obligatoire.")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez renseigner une adresse.")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address_complement;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Veuillez choisir un code postal.")
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez choisir une ville.")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez choisir un pays.")
     */
    private $country;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mobile_phone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $receive_info;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $amountOnce;

    /**
     * @ORM\Column(type="integer")
     */
    private $amountFree;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir une adresse email.")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez choisir une civilité")
     */
    private $civility;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddressComplement(): ?string
    {
        return $this->address_complement;
    }

    public function setAddressComplement(string $address_complement): self
    {
        $this->address_complement = $address_complement;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postal_code;
    }

    public function setPostalCode(int $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getMobilePhone(): ?int
    {
        return $this->mobile_phone;
    }

    public function setMobilePhone(?int $mobile_phone): self
    {
        $this->mobile_phone = $mobile_phone;

        return $this;
    }

    public function getReceiveInfo(): ?bool
    {
        return $this->receive_info;
    }

    public function setReceiveInfo(?bool $receive_info): self
    {
        $this->receive_info = $receive_info;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAmountOnce(): ?int
    {
        return $this->amountOnce;
    }

    public function setAmountOnce(int $amountOnce): self
    {
        $this->amountOnce = $amountOnce;

        return $this;
    }

    public function getAmountFree(): ?int
    {
        return $this->amountFree;
    }

    public function setAmountFree(int $amountFree): self
    {
        $this->amountFree = $amountFree;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCivility(): ?string
    {
        return $this->civility;
    }

    public function setCivility(string $civility): self
    {
        $this->civility = $civility;

        return $this;
    }
}
