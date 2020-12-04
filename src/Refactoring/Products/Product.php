<?php

namespace Refactoring\Products;

use Brick\Math\BigDecimal;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Product
{
    /**
     * @var UuidInterface
     */
    private $serialNumber;

    /**
     * @var BigDecimal
     */
    private $price;

    /**
     * @var string
     */
    private $desc;

    /**
     * @var string
     */
    private $longDesc;

    /**
     * @var int
     */
    private $counter;

    /**
     * Product constructor.
     * @param BigDecimal|null $price
     * @param string|null $desc
     * @param string|null $longDesc
     * @param int|null $counter
     */
    public function __construct(?BigDecimal $price, ?string $desc, ?string $longDesc, ?int $counter)
    {
        $this->serialNumber = Uuid::uuid4();
        $this->price = $price;
        $this->desc = $desc;
        $this->longDesc = $longDesc;
        $this->counter = $counter;
    }

    /**
     * @return UuidInterface
     */
    public function getSerialNumber(): UuidInterface
    {
        return $this->serialNumber;
    }

    /**
     * @return BigDecimal
     */
    public function getPrice(): BigDecimal
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }

    /**
     * @return string
     */
    public function getLongDesc(): string
    {
        return $this->longDesc;
    }

    /**
     * @return int
     */
    public function getCounter(): int
    {
        return $this->counter;
    }

    /**
     * @throws \Exception
     */
    public function decrementCounter(): void
    {
        if ($this->price != null && $this->price->getSign() > 0) {
            if ($this->counter === null) {
                throw new \Exception("null counter");
            }

            $this->counter = $this->counter - 1;

            if ($this->counter < 0) {
                throw new \Exception("Negative counter");
            }
        } else {
            throw new \Exception("Invalid price");

        }
    }

    /**
     * @throws \Exception
     */
    public function incrementCounter(): void
    {
        if ($this->price != null && $this->price->getSign() > 0) {
            if ($this->counter === null) {
                throw new \Exception("null counter");
            }

            if ($this->counter + 1 < 0) {
                throw new \Exception("Negative counter");
            }

            $this->counter = $this->counter + 1;
        } else {
            throw new \Exception("Invalid price");
        }
    }

    /**
     * @param BigDecimal|null $newPrice
     * @throws \Exception
     */
    public function changePriceTo(?BigDecimal $newPrice): void
    {
        if ($this->counter === null) {
            throw new \Exception("null counter");
        }

        if ($this->counter > 0) {
            if ($newPrice === null) {
                throw new \Exception("new price null");
            }

            $this->price = $newPrice;
        }
    }

    /**
     * @param string|null $charToReplace
     * @param string|null $replaceWith
     * @throws \Exception
     */
    public function replaceCharFromDesc(?string $charToReplace, ?string $replaceWith): void
    {
        if ($this->longDesc === null || empty($this->longDesc) || $this->desc === null || empty($this->desc)) {
            throw new \Exception("null or empty desc");
        }

        $this->longDesc = str_replace($charToReplace, $replaceWith, $this->longDesc);
        $this->desc = str_replace($charToReplace, $replaceWith, $this->desc);
    }

    /**
     * @return string
     */
    public function formatDesc(): string {
        if ($this->longDesc === null || empty($this->longDesc) || $this->desc === null || empty($this->desc)) {
            return "";
        }

        return $this->desc . " *** " . $this->longDesc;
    }
}





















