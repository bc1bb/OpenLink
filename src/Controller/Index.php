<?php

namespace App\Controller;

use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\GetVersion;
class Index extends AbstractController
{
    #[Route('/', methods: ['GET'])]
    public function index(Request $request): Response
    {
        // In case of legacy link
        $params = $request->query->all();
        if ($params) {
            return $this->redirect("/".array_key_first($params), 307);
        }

        // TODO: switch to not "dev"
        $version = GetVersion::get_current_commit("develop", true);

        return $this->render('index.html.twig', [ "error" => false, "version" => $version]);
    }
}