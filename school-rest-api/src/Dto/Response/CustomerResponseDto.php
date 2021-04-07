<?php declare(strict_types=1);


namespace App\Dto\Response;


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
    private ?string $firstname = '';

    /**
     * @Serialization\Type("string")
     */
    private ?string $lastname = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return CustomerResponseDto
     */
    public function setId(int $id): CustomerResponseDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CustomerResponseDto
     */
    public function setEmail(string $email): CustomerResponseDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return CustomerResponseDto
     */
    public function setFirstname(?string $firstname): CustomerResponseDto
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return CustomerResponseDto
     */
    public function setLastname(?string $lastname): CustomerResponseDto
    {
        $this->lastname = $lastname;
        return $this;
    }


}