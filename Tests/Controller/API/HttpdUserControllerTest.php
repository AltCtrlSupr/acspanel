<?php

namespace ACS\ACSPanelBundle\Tests\Controller\API;

use ACS\ACSPanelBundle\Tests\Controller\CommonTestCase;

class HttpdUserControllerTest extends CommonTestCase
{
    public function testHttpdUsersScenario()
    {
		$client = $this->createSuperadminClient();

		$crawler = $this->client->request('GET', '/api/httpdusers/index.json');

		$this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Check if the respense contents are json
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
    }
}
