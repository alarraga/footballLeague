<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


	//get League
	public function getLeagueIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/league');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

	//get footballTeam
	public function getTeamIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/team');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

	//insert League
	public function insertLeagueIndex()
    {
        $client = static::createClient();

		$nickname = 'ObjectOrienter'.rand(0, 999);
		$data = array(
			'name' => $nickname
		);
        $crawler = $client->request('POST', '/league/insert', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
	
	//update league
	public function updateLeagueIndex()
    {
        $client = static::createClient();

		$nickname = 'ObjectOrienter'.rand(0, 999);
		$id = rand(0,999);
		$data = array(
			'name' => $nickname
		);
        $crawler = $client->request('POST', '/league/update/{$i}', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

	//delete League
	public function deletetLeagueIndex()
    {
        $client = static::createClient();

		$nickname = 'ObjectOrienter'.rand(0, 999);
		$id = rand(0,999);
		
        $crawler = $client->request('GET', '/league/delete/{$i}');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

	//insert team
	public function insertteamIndex()
    {
        $client = static::createClient();

		$nickname = 'ObjectOrienter'.rand(0, 999);
		$id = rand(0,999);
		$data = array(
			'name' => $nickname,
			'strip'=> $nickname,
			'football_leagueid'=>$id
		);
        $crawler = $client->request('POST', '/team/insert', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    //update team
	public function updateteamIndex()
    {
        $client = static::createClient();

		$nickname = 'ObjectOrienter'.rand(0, 999);
		$id = rand(0,999);
		$data = array(
			'name' => $nickname,
			'strip'=> $nickname,
			'football_leagueid'=>$id
		);
        $crawler = $client->request('POST', '/team/update/{$i}', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
	
    //delete team
	public function deleteteamIndex()
    {
        $client = static::createClient();


		$id = rand(0,999);
        $crawler = $client->request('GET', '/team/delete/{$i}', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
