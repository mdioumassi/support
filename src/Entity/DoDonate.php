<?php

namespace App\Entity;

use App\Repository\DoDonateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=DoDonateRepository::class)
 */
class DoDonate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom est obligatoire.")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'email est obligatoire")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="la civilité est obligatoire")
     */
    private $civility;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="l'adresse est obligatoire")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     */
    private $address_complement;

    /**
     * @ORM\Column(type="integer")
     */
    private $postal_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le pays est obligatoire.")
     */
    private $country;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mobile_phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $amount_free;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     */
    private $amount_once;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $receive_info;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

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

    public function setMobilePhone(int $mobile_phone): self
    {
        $this->mobile_phone = $mobile_phone;

        return $this;
    }

    public function getAmountFree(): ?int
    {
        return $this->amount_free;
    }

    public function setAmountFree(?int $amount_free): self
    {
        $this->amount_free = $amount_free;

        return $this;
    }

    public function getAmountOnce(): ?int
    {
        return $this->amount_once;
    }

    public function setAmountOnce(?int $amount_once): self
    {
        $this->amount_once = $amount_once;

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
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
