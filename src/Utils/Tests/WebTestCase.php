<?php declare(strict_types=1);

namespace App\Utils\Tests;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WebTestCase extends BaseWebTestCase
{
    /**
     * @var ContainerInterface
     */
    protected $testContainer;

    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
    }
}