<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    private $entityManagerInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    #[Route('/api/getProject/{id}', name: 'project', methods: ['GET'])]
    public function index($id): Response
    {
        // Get projects repository
        $projectRepository = $this->entityManagerInterface->getRepository(Project::class);
        // Get current project from repository
        $project = $projectRepository->find($id);

        // Return project's data
        return $this->json([
            'id' => $project->getID(),
            'title' => $project->getTitle(),
            'type_id' => $project->getType()->getID(),
            'type_slug' => $project->getType()->getSlug(),
            'cover' => $project->getCover(),
            'content' => $project->getContent(),
        ]);
    }
}
