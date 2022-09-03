<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/{spaRouting}', name: 'index', requirements: ['spaRouting' => '.*'], defaults: ["spaRouting" => null], methods: ['GET'], priority: "-1")]
    public function index(): Response
    {
        // Render SPA template
        return $this->render('index.html.twig');
    }

}
