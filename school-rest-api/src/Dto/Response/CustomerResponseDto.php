<?php declare(strict_types=1);


namespace App\Dto\Response;


use DateTimeInterface;
use JMS\Serializer\Annotation as Serialization;

class CustomerResponseDto
{

    /**
     * @Serialization\Type("int")
     */
    private int $id;

    /**
     * @Serialization\Type("string")
     */
    private string $email;

    /**
     * @Serialization\Type("string")
     */
    private string $firstname;

    /**
     * @Serialization\Type("string")
     */
    private string $lastname;

    /**
     * @Serialization\Type("string")
     */
    private string $street;

    /**
     * @Serialization\Type("string")
     */
    private string $city;

    /**
     * @Serialization\Type("string")
     */
    private string $postalCode;

    /**
     * @Serialization\Type("DateTimeInterface")
     */
    private DateTimeInterface $created_at;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CustomerResponseDto
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): CustomerResponseDto
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): CustomerResponseDto
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): CustomerResponseDto
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): CustomerResponseDto
    {
        $this->street = $street;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): CustomerResponseDto
    {
        $this->city = $city;
        return $this;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postal_code): CustomerResponseDto
    {
        $this->postalCode = $postal_code;
        return $this;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTimeInterface $created_at): CustomerResponseDto
    {
        $this->created_at = $created_at;
        return $this;
    }

}