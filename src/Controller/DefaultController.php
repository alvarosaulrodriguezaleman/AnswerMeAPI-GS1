<?php

namespace App\Controller;

use App\Service\DataAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function index(DataAccess $dataAccess)
    {
        dump($dataAccess->getUser("nahuel"));
        return $this->render('base.html.twig');
    }
}