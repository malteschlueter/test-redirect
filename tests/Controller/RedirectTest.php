<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RedirectTest extends WebTestCase
{
    public function testRemoveQueryParams(): void
    {
        $client = static::createClient();

        $client->request('GET', '/aParam/my-legacy-url.php?additional-param=foo&another-param=bar');

        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/?myparam=aParam'));
    }

    public function testKeepQueryParams(): void
    {
        $client = static::createClient();

        $client->request('GET', '/aParam/keep-my-legacy-url.php?additional-param=foo&another-param=bar');

        $this->assertTrue($client->getResponse()->isRedirect('http://localhost/?additional-param=foo&another-param=bar&myparam=aParam'));
    }
}
