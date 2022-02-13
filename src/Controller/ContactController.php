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

class ContactController extends AbstractController
{

     /**
     * @Route("/", name="home_contact")
     */
    public function contact(Request $request,EntityManagerInterface $manager,MailerInterface $mailer, ProjectRepository $projectRepository): Response {
        
        $this->projectRepository = $projectRepository;
        $projects = $this->projectRepository->findAll();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $contactMail = $form->handleRequest($request);
        $message = "";
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($contact);
            $manager->flush();

            $email = (new TemplatedEmail())
                ->from($contactMail->get('email')->getData())
                ->to('contact@aliramzan.com')
                ->subject('Demande de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'mail' => $contactMail->get('email')->getData(),
                    'content' => $contactMail->get('content')->getData(),
                    'firstname' => $contactMail->get('firstname')->getData(),
                    'lastname' => $contactMail->get('lastname')->getData(),
                    'phone' => $contactMail->get('phone')->getdata(),
                    $message = "Your message has been sent!"

                ]);
            $mailer->send($email);
            $this->addFlash('message', 'Your message has been sent!');
            return $this->redirectToRoute('home_contact');
        }
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
            'projects' => $projects
        ]);
    }
    
}
