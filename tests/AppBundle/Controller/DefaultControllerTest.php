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

        $crawler = $client->request('GET', '/getLeague');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

	//get footballTeam
	public function getTeamIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getTeam');

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
        $crawler = $client->request('GET', '/insertLeague', $data);

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
        $crawler = $client->request('GET', '/updateLeague/{$i}', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

	//delete League
	public function deletetLeagueIndex()
    {
        $client = static::createClient();

		$nickname = 'ObjectOrienter'.rand(0, 999);
		$id = rand(0,999);
		
        $crawler = $client->request('GET', '/deleteLeague/{$i}');

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
        $crawler = $client->request('GET', '/insertTeam', $data);

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
        $crawler = $client->request('GET', '/updateTeam/{$i}', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
	//delete team
	public function deleteteamIndex()
    {
        $client = static::createClient();


		$id = rand(0,999);
        $crawler = $client->request('GET', '/deleteTeam/{$i}', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
