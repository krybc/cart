<?php

declare(strict_types=1);

namespace App\Component\Order\Storage;

use App\Component\Order\Model\OrderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderSessionStorage implements OrderStorageInterface
{
    private const ORDER_KEY_NAME = 'orderId';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function set(string $orderId): void
    {
        $this->session->set(self::ORDER_KEY_NAME, $orderId);
    }

    public function remove(): void
    {
        $this->session->remove(self::ORDER_KEY_NAME);
    }

    public function getOrderById(): ?OrderInterface
    {
        if ($this->has()) {
            return $this->entityManager->getRepository('App\Component\Order\Model:Order')->findOneById($this->get());
        }

        return null;
    }

    public function has(): bool
    {
        return $this->session->has(self::ORDER_KEY_NAME);
    }

    public function get(): string
    {
       return $this->session->get(self::ORDER_KEY_NAME);
    }
}