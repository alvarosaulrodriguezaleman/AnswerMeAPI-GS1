<?php

namespace App\Controller;

use App\Service\DataAccess;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    /**
     * @Route("/api/getUser/{user}", name="getUser", methods={"GET"})
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getUserByName(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getUser($user));
    }

    /**
     * @Route("/api/getPregunta/{pregunta}", name="getPregunta", methods={"GET"})
     * @param string $pregunta
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getPregunta(string $pregunta, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getPregunta($pregunta));
    }

    /**
     * @Route("/api/createUser", name="createUser")
     * @param DataAccess $dataAccess
     * @return string
     */
    public function createUser(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["USERNAME"])) {
            $dataAccess->createUser(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }
}