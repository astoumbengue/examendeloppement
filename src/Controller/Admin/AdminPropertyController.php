<?php

namespace App\Controller\Admin;

use App\Repository\MaisonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Notification\ContactNotification;
use App\Entity\Maison;
use App\Form\MaisonType;

class AdminPropertyController extends AbstractController
{
	/**
     * @var MaisonRepository
     */
    private $repository;

     /**
     * @var EntityManagerInterface
     */
      private $em;
    public function __construct(MaisonRepository $repository ,EntityManagerInterface $em)
    {
        $this->repository= $repository;
        $this->em= $em;
    }

     /**
     * @Route("/admin/property/create", name="admin.property.new")
      * @ParamConverter("request")
     * @return \Symfony\Component\HttpFoundation\Response;

     */
     public function new(Request $request)
    {
        $property = new Maison();

        $form = $this->createForm(MaisonType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien ajouté avec succès');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', 
        	['property' => $property,
        	 'form' => $form->createView()]);

    }
	/**
     * @Route("/admin", name="admin.property.index", methods="GET|POST")
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function index()
    {
    
        $properties = $this->repository->findAll();

        return $this->render('admin/property/index.html.twig'
        	, ['properties' => $properties]);
    }
    /**
     * @Route("/admin/{id}", name="admin.property.edit")
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function edit(Maison $property, Request $request)
    {
    	$form = $this->createForm(MaisonType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index');
        }
      
        return $this->render('admin/property/edit.html.twig',
         [
         	'property' => $property,
            'form' => $form ->createView()

     ]);
    }
    /**
     * @Route("/admin/property/{id}", name="admin.property.delete",methods="DELETE")
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    
public function delete(Maison $property, Request $request)
    {
     if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();

            $this->addFlash('success', 'Bien supprimé avec succès');
            return $this->redirectToRoute('admin.property.index');
        }

       
    }
}