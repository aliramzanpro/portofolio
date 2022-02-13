<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project-details/{id}", name="project_details")
     */
    public function details(?Project $project): Response
    {
        if (!$project) {
            return $this->redirectToRoute('home');
        }
        return $this->render('project/index.html.twig', [
            'project' => $project,
            
        ]);
    }
}
