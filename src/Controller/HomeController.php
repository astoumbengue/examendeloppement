<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\MaisonRepository;

class HomeController extends AbstractController
{
	 /**
     * @Route("/", name="home")
     * @param MaisonRepository $repository
     * @return Response
     */
    public function index(MaisonRepository $repository): Response
    {
     $properties= $repository ->findLatest();
        return $this->render('pages/home.html.twig', [
        	'properties' => $properties
        ]);
    }
}