<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\FootballLeague;
use AppBundle\Entity\FootballTeam;
use Doctrine\DBAL\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TeamController extends Controller
{

	/**
     * @Route("/team", name="getTeam")
	 * @Method({"GET"})
     */
	public function getTeamAction() {

		$em = $this->getDoctrine()->getRepository(FootballTeam::class);
		$foot = $em->findAll(); 
		$i=0;
		$data = array();
		foreach($foot as $key => $result)
		{
			$data[$result->getId()]['name'] = $result->getName();
			$data[$result->getId()]['strip'] = $result->getStrip();
			$data[$result->getId()]['football_leagueid'] = $result->getFootballLeagueid();
		}
		$response['success'] = true;
		$response['data'] = $data;
		return new \Symfony\Component\HttpFoundation\JsonResponse($response);
	}


	/**
     * @Route("/team/insert", name="insertTeam")
	 * @Method({"POST"})
     */
	public function insertTeamAction(Request $request) {

		if ("POST" == $request->getMethod()) {
			$param = $request->request->all();
			$name = $param['name'];
			$strip = $param['strip'];
			$football_leagueid = $param['football_leagueid'];
		}
		else {
			$param = $request->query;
			$name = $param->get('name');;
			$strip = $param->get('strip');
			$football_leagueid = $param->get('football_leagueid');;
		}

		if(empty($name) || empty($strip) || empty($football_leagueid)) {
			$data["success"] = false;
		} else {
			$entityManager = $this->getDoctrine()->getManager();
			$product = $entityManager->getRepository(FootballLeague::class)->find($football_leagueid);

			if (!$product) {
				$data["success"] = false;
			} else {
				$em = $this->getDoctrine()->getManager();
				$football = new FootballTeam();
				$football->setName($name);
				$football->setFootballLeagueid($football_leagueid);

				$football->setStrip($strip);


				$em->persist($football);
				$em->flush();
				$data["success"] = true;
			}
		}
		return new \Symfony\Component\HttpFoundation\JsonResponse($data);
	}


	/**
     * @Route("/team/update/{id}", name="updateTeam")
	 * @Method({"POST"})
     */
	public function updateTeamAction(Request $request,$id) {
		
		if ("POST" == $request->getMethod()) {
			$param = $request->request->all();
			$name = $param['name'];
			$strip = $param['strip'];
			$football_leagueid = $param['football_leagueid'];
		}
		else {
			$param = $request->query;
			$name = $param->get('name');;
			$strip = $param->get('strip');;
			$football_leagueid = $param->get('football_leagueid');;
		}

		if(empty($name) || empty($strip) || empty($football_leagueid) ) {
			$data["success"] = false;
		} else {
			$entityManager1 = $this->getDoctrine()->getManager();
			$product1 = $entityManager1->getRepository(FootballLeague::class)->find($football_leagueid);
			if(!$product1)
				$data["success"] = false;
			else {

				$entityManager = $this->getDoctrine()->getManager();
				$product = $entityManager->getRepository(FootballTeam::class)->find($id);

				if (!$product) {
					$data["success"] = false;
				} else {
					$data["success"] = true;

					$product->setName($name);
					$product->setFootballLeagueid($football_leagueid);
					$product->setStrip($strip);
					$entityManager->flush();
				}
			}
		}
		return new \Symfony\Component\HttpFoundation\JsonResponse($data);
	}

	/**
     * @Route("/team/delete/{id}", name="deleteTeam")
	 * @Method({"GET"})
     */
	public function deleteTeamAction(Request $request,$id) {
		
		$entityManager = $this->getDoctrine()->getManager();
		$product = $entityManager->getRepository(FootballTeam::class)->find($id);
		$data["success"] = false;
		if (!$product) {
			$data["success"] = false;
		} else {
			$data["success"] = true;
			$entityManager->remove($product);
			$entityManager->flush();
		}
		return new \Symfony\Component\HttpFoundation\JsonResponse($data);
	}
}
