<?php

namespace App\Controller;

use App\Entity\Page;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    private $entityManagerInterface;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    #[Route('/api/getPage/{slug}', name: 'page', methods: ['GET'])]
    public function index($slug): Response
    {
        // Get page repository
        $pageRepository = $this->entityManagerInterface->getRepository(Page::class);
        // Get current page from repository
        $page = $pageRepository->findOneBy(['slug' => $slug]);
        // Return page data
        if ($page) {
            return $this->json([
                'id' => $page->getID(),
                'title' => $page->getTitle(),
                'slug' => $page->getSlug(),
                'content' => $page->getContent(),
            ]);
        }

        return false;
    }
}
