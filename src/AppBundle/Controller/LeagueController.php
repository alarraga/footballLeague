<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\FootballLeague;
use AppBundle\Entity\FootballTeam;
use Doctrine\DBAL\Exception;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LeagueController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
    	$data["redirect"] = '';
    	$data["isuser"] = true;        
    	return new \Symfony\Component\HttpFoundation\JsonResponse($data);
    }

	/**
     * @Route("/league", name="getLeague")
	 * @Method({"GET"})
     */
	public function getLeagueAction() {

		$em = $this->getDoctrine()->getRepository(FootballLeague::class);
		$foot = $em->findAll(); 
		$data = array();
		foreach($foot as $key => $result)
		{
			$data[$result->getId()] = $result->getName();
		}
		$response['success'] = true;
		$response['data'] = $data;
		return new \Symfony\Component\HttpFoundation\JsonResponse($response);
	}

	/**
     * @Route("/league/insert", name="insert-League")
	 * @Method({"POST"})
     */
	public function insertLeagueAction(Request $request) {

		if ("POST" == $request->getMethod()) {
			$param = $request->request->all();
			$name = $param['name'];
		}
		else {
			$param = $request->query;
			if(!$param) {
				$data["success"] = false;
			} else {
				
				$name = $param->get('name');;
			}			
		}

		if(empty($name)) {
			$data["success"] = false;
		} else {
			$em = $this->getDoctrine()->getManager();
			$football = new FootballLeague();
			$football->setName($name);
			$em->persist($football);
			$em->flush();
			$data["success"] = true;
		}
		
		return new \Symfony\Component\HttpFoundation\JsonResponse($data);
	}


	/**
     * @Route("/league/update/{id}", name="updateLeague")
	 * @Method({"POST"})
     */
	public function updateLeagueAction(Request $request,$id) {
		
		if ("POST" == $request->getMethod()) {
			$param = $request->request->all();
			$name = $param['name'];
		}
		else {
			$param = $request->query;
			$name = $param->get('name');;
		}

		if(empty($name)) {
			$data["success"] = false;
		} else {
			$entityManager = $this->getDoctrine()->getManager();
			$product = $entityManager->getRepository(FootballLeague::class)->find($id);

			if (!$product) {
				$data["success"] = false;
			} else {
				$data["success"] = true;

				$product->setName($name);
				$entityManager->flush();
			}
		}
		return new \Symfony\Component\HttpFoundation\JsonResponse($data);
	}

	/**
     * @Route("/league/delete/{id}", name="deleteLeague")
	 * @Method({"GET"})
     */
	public function deleteLeagueAction(Request $request,$id) {
		
		$entityManager = $this->getDoctrine()->getManager();
		$product = $entityManager->getRepository(FootballLeague::class)->find($id);
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
