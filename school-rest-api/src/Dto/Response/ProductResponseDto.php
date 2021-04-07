<?php declare(strict_types=1);


namespace App\Dto\Response;


use JMS\Serializer\Annotation as Serialization;

class ProductResponseDto
{
    /**
     * @Serialization\Type("int")
     */
    private int $id;

    /**
     * @Serialization\Type("string")
     */
    private string $code;

    /**
     * @Serialization\Type("string")
     */
    private string $name;

    /**
     * @Serialization\Type("float")
     */
    private float $price;

    /**
     * @Serialization\Type("string")
     */
    private ?string $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): ProductResponseDto
    {
        $this->id = $id;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): ProductResponseDto
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductResponseDto
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): ProductResponseDto
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): ProductResponseDto
    {
        $this->description = $description;
        return $this;
    }


}