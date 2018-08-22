<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\FootballLeague;
use AppBundle\Entity\FootballTeam;
use Doctrine\DBAL\Exception;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        /*return $this->render('AppBundle:Default:index.html.twig',array(
          'AUTH0_DOMAIN' => $this->container->getParameter('jwt_auth.domain'),
          'AUTH0_CLIENT_ID' => $this->container->getParameter('jwt_auth.client_id')
        ));*/
		$data["redirect"] = '';
        $data["isuser"] = true;        
        return new \Symfony\Component\HttpFoundation\JsonResponse($data);
    }

	/**
     * @Route("/insertLeague", name="insert-League")
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
     * @Route("/getLeague", name="getLeague")
     */
    public function getLeagueAction() {

		$em = $this->getDoctrine()->getRepository(FootballLeague::class);
        $foot = $em->findAll(); 
		foreach($foot as $key => $result)
		{
			$data[$result->getId()] = $result->getName();
		}
		$data['success'] = true;
        return new \Symfony\Component\HttpFoundation\JsonResponse($data);
    }

	/**
     * @Route("/updateLeague/{id}", name="updateLeague")
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
     * @Route("/deleteLeague/{id}", name="deleteLeague")
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






	/**
     * @Route("/insertTeam", name="insertTeam")
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
     * @Route("/getTeam", name="getTeam")
     */
    public function getTeamAction() {

		$em = $this->getDoctrine()->getRepository(FootballTeam::class);
        $foot = $em->findAll(); 
		$i=0;
		foreach($foot as $key => $result)
		{
			$data[$result->getId()]['name'] = $result->getName();
			$data[$result->getId()]['strip'] = $result->getStrip();
			$data[$result->getId()]['football_leagueid'] = $result->getFootballLeagueid();
		}
		$data['success'] = true;
        return new \Symfony\Component\HttpFoundation\JsonResponse($data);
    }

	/**
     * @Route("/updateTeam/{id}", name="updateTeam")
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
     * @Route("/deleteTeam/{id}", name="deleteTeam")
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

    