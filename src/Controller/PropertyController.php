<?php

namespace App\Controller;


use App\Entity\Maison;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\MaisonRepository;
use App\Notification\ContactNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class PropertyController extends AbstractController
{
/**
 * @var MaisonRepository
 */
private $repository;


    /**
     * @var ObjectManager
     */
    private $em;
    public function __construct(MaisonRepository $repository, EntityManagerInterface $em)
    {
        $this->repository= $repository;
         $this->em= $em;
    }
    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        $properties=$this->repository->findAllVisible();
    
        return $this->render('property/index.html.twig', [
            'properties' => $properties
        ]);
    }
    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug,$id, Request $request): Response
    {
        $property = new Maison();
       $contact = new Contact();
        $contact->setProperty($property);
       $form = $this->createForm(ContactType::class, $contact);
       // $form->handleRequest($request);

          //if ($form->isSubmitted() && $form->isValid()) {
           // $notification->notify($contact);
           // $this->addFlash('success', 'Votre email a bien été envoyé');
           // return $this->redirectToRoute('property.show',
               // ['id' => $property->getId(), 'slug' => $property->getSlug()]);
       // }


        $property=$this->repository->find($id);
      return $this->render('property/show.html.twig', 
        ['property' => $property
        , 
        'form' => $form->createView()
    ]);

        }

}