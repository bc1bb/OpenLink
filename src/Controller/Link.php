<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\GetVersion;

class Link extends AbstractController
{
    #[Route('/link', methods: ['GET', 'POST'])]
    public function link(): Response
    {
        // TODO: switch to not "dev"
        $version = GetVersion::get_current_commit("master", true);

        return $this->render('link.html.twig', ["version" => $version, "link" => "https://onlk.ovh/?ExAmPlE"]);
    }
}