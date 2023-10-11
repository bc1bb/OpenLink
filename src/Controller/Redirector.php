<?php

namespace App\Controller;

use App\Entity\Links;
use App\GetVersion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Redirector extends AbstractController
{
    #[Route('/{shorten}', name: 'redirector', methods: ['GET'])]
    public function redirector(string $shorten, EntityManagerInterface $entity_manager): Response
    {
        $long_link = $entity_manager->getRepository(Links::class)->findOneBy(["shorten" => $shorten]);

        if (! $long_link) {
            $version = GetVersion::get_current_commit("master", true);

            return $this->render('index.html.twig', [ "error" => "Invalid Link", "version" => $version]);
        }

        $long_link_str = $long_link->getOriginal();

        return $this->redirect($long_link_str, 307);
    }
}