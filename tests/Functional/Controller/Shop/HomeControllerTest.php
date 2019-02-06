<?php declare(strict_types=1);

namespace App\Tests\Functional\Controller\Shop;

use App\Utils\Tests\WebTestCase;
use Symfony\Component\VarDumper\VarDumper;

class HomeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertGreaterThan(0, $crawler->filter('table.table')->count());
    }

    public function testAddToCart()
    {
        $crawler = $this->client->request('GET', '/');

        $row = $crawler->filter('table tbody tr:first-child');
        $itemName = $row->filter('td:first-child')->text();
        $form = $row->filter('form[name="add_item"]')->form();
        $itemId = $form->get('add_item[id]')->getValue();

        $crawler = $this->client->submit($form);
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());

        $crawler = $this->client->followRedirect();

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($crawler->filter('td:contains(' . $itemName . ')')->count(), 1);
    }
}