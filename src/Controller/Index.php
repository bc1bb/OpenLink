<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\GetVersion;

class Index extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function index(): Response
    {
        // TODO: switch to not "dev"
        $version = GetVersion::get_current_commit("master", true);

        return $this->render('index.html.twig', ["version" => $version]);
    }
}