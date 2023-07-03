<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\GetVersion;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Validation;

class Shortener extends AbstractController
{
    #[Route('/link', methods: ['POST'])]
    public function posting_link(Request $request): Response
    {
        $version = GetVersion::get_current_commit("develop", true);
        $long_link = $request->get("link");
        $validator = Validation::createValidator();
        $violation = $validator->validate($long_link, new Url);

        if(count($violation) !== 0) {
            return $this->render('index.html.twig', [ "error" => "Invalid link", "version" => $version]);
        }

        return $this->render('link.html.twig', [ 'version' => $version, 'link' => $long_link ]);
    }
}