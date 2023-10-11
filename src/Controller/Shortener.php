<?php

namespace App\Controller;

use App\Entity\Links;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\GetVersion;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Validation;

class Shortener extends AbstractController
{
    #[Route('/link', methods: ['POST'])]
    public function posting_link(Request $request, EntityManagerInterface $entity_manager): Response
    {
        $version = GetVersion::get_current_commit("master", true);
        $long_link = $request->get("link");
        $validator = Validation::createValidator();
        $violation = $validator->validate($long_link, new Url);

        if(count($violation) !== 0) {
            return $this->render('index.html.twig', [ "error" => "Invalid link", "version" => $version ]);
        }

        $short_link = new Links();
        $short_link->setOriginal($long_link);
        $short_link->setCreation(time());
        $short_link->setShorten(self::random_str());

        $entity_manager->persist($short_link);
        $entity_manager->flush();

        return $this->render('link.html.twig', [ 'version' => $version, 'link' => "https://onlk.ovh/".$short_link->getShorten() ]);
    }

    private static function random_str(): string {
        $dict = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $size = 8;
        $randomized = [];

        $dict_split = str_split($dict);

        for($i = 0; $i <= $size; $i++) {
            $randomized []= $dict_split[random_int(0,mb_strlen($dict)-1)];
        }

        return implode("", $randomized);
    }
}