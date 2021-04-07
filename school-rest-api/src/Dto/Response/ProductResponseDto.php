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

    /**
     * @param int $id
     * @return ProductResponseDto
     */
    public function setId(int $id): ProductResponseDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return ProductResponseDto
     */
    public function setCode(string $code): ProductResponseDto
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductResponseDto
     */
    public function setName(string $name): ProductResponseDto
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return ProductResponseDto
     */
    public function setPrice(float $price): ProductResponseDto
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return ProductResponseDto
     */
    public function setDescription(?string $description): ProductResponseDto
    {
        $this->description = $description;
        return $this;
    }


}