<?php

namespace ACS\ACSPanelBundle\Tests\Controller\API;

class DomainControllerTest extends CommonApiTestCase
{
    public function testDomainScenario()
    {
		$client = $this->createSuperadminClient();

		$crawler = $this->client->request('GET', '/api/domains/index.json');

		$this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Check if the respense contents are json
        $this->assertJson($client);

        $this->assertRegExp('/{"id":1,"domain":"0domain.tld"/', $client->getResponse()->getContent());

        $this->assertNotRegExp('/password/', $client->getResponse()->getContent());

        // Show one domain
		$crawler = $this->client->request('GET', '/api/domains/1/show.json');

		$this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        // Check if the respense contents are json
        $this->assertJson($client);

        // Creating new domains with body
        $crawler = $this->client->request('POST', '/api/domains/create.json', array(
            'acs_acspanelbundle_domaintype' => array('domain' => 'test.cat')
        ), array(), array('accept-header' => 'application/json'));

        // Check if the respense contents are json
        $this->assertJson($client);
    }
}

