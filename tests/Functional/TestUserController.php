<?php
namespace App\tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Controller\UsersController;

class PostControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $client->request('GET', '/login');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testShowUser()
    {
        $client = static::createClient();

        $client->request('GET', '/users');

        $this->assertEquals(301, $client->getResponse()->getStatusCode());
    }
}