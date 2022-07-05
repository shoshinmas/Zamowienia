<?php

declare(strict_types=1);

namespace App\Entity;

use App\OrderItem\OrderItem;
use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Form\Extension\Core\Type\UuidType;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(name: "uuid", type: "uuid", unique: true, nullable: true)]
    private UuidInterface $uuid;

    #[ORM\Column(type: 'integer')]
    private int $totalSum;

    #[ORM\Column(type: 'string', length: 255)]
    private string $status;

    #[ORM\Column(type: 'integer')]
    private int $quantity;

    #[ORM\Column(name: "orderitem", type: 'array', nullable: true)]
    private array $orderItem = [];

    #[ORM\Column(type: 'string', length: 255)]
    private string $clientEmail;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalSum(): ?int
    {
        return $this->totalSum;
    }

    public function setTotalSum(int $totalSum): self
    {
        $this->totalSum = $totalSum;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrderItem(OrderItem $newOrderItem): array
    {
        $currentItem = null;

        foreach ($this->orderItem as $orderItem) {
            if ($newOrderItem->isSame($orderItem)) {
                $currentItem = $orderItem;
                break;
            }
        }

        return $currentItem;
    }

    public function addOrderItem(OrderItem $newOrderItem): void
    {
        $currentItem = $this->getOrderItem($newOrderItem);

        $currentItem->increaseQuantity();

        $currentItemKey = array_search($currentItem, $this->orderItem);

        $this->orderItem[$currentItemKey] = clone $currentItem;
    }

    public function setOrderItem(array $array): void
    {
        $this->orderItem = $array;
    }

    public function clearOrderItem(): void
    {
        $this->orderItem = [];
    }

    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): self
    {
        $this->clientEmail = $clientEmail;

        return $this;
    }

    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    public function setUuId(UuidInterface $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }
}