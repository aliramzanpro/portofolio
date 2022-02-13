<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    
     /**
     * @Route("/", name="home")
     */
    
    public function index(ProjectRepository $projectRepository): Response 
    {
        $this->projectRepository = $projectRepository;
        $projects = $this->projectRepository->findAll();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $message = "";
        return $this->render('home/index.html.twig', [
            'projects' => $projects,
            'form' => $form->createView(),
            'message' => $message,        
            
        ]);
    }
    




}
