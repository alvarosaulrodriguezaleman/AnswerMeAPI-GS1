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
     * @Route("/api/getUser/{user}", name="getUser")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getUserByName(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getUser($user));
    }

    /**
     * @Route("/api/getPregunta/{id}", name="getPregunta")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getPregunta(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getPregunta($id));
    }

    /**
     * @Route("/api/getPreguntasFromUser/{user}", name="getPreguntasFromUser")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getPreguntasFromUser(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getPreguntasFromUser($user));
    }

    /**
     * @Route("/api/getFeedPreguntas/{user}", name="getFeedPreguntas")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getFeedPreguntas(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getFeedPreguntas($user));
    }

    /**
     * @Route("/api/getEncuesta/{id}", name="getEncuesta")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getEncuesta(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getEncuesta($id));
    }

    /**
     * @Route("/api/getEncuestasFromUser/{id}", name="getEncuestasFromUser")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getEncuestasFromUser(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getEncuestasFromUser($id));
    }

    /**
     * @Route("/api/getFeedEncuestas/{user}", name="getFeedEncuestas")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getFeedEncuestas(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getFeedEncuestas($user));
    }

    /**
     * @Route("/api/getFeedEncuestasOptions/{user}", name="getFeedEncuestasOptions")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getFeedEncuestasOptions(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getFeedEncuestasOptions($user));
    }

    /**
     * @Route("/api/getPreguntaMultiopcion/{id}", name="getPreguntaMultiopcion")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getPreguntaMultiopcion(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getPreguntaMultiopcion($id));
    }

    /**
     * @Route("/api/getPreguntasMultiopcionFromUser/{id}", name="getPreguntasMultiopcionFromUser")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getPreguntasMultiopcionFromUser(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getPreguntasMultiopcionFromUser($id));
    }

    /**
     * @Route("/api/getFeedPreguntasMultiopcion/{user}", name="getFeedPreguntasMultiopcion")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getFeedPreguntasMultiopcion(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getFeedPreguntasMultiopcion($user));
    }

    /**
     * @Route("/api/getFeedPreguntasMultiopcionOptions/{user}", name="getFeedPreguntasMultiopcionOptions")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getFeedPreguntasMultiopcionOptions(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getFeedPreguntasMultiopcionOptions($user));
    }

    /**
     * @Route("/api/getSiguiendo/{user}", name="getSiguiendo")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getSiguiendo(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getSiguiendo($user));
    }

    /**
     * @Route("/api/getSeguidores/{user}", name="getSeguidores")
     * @param string $user
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getSeguidores(string $user, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getSeguidores($user));
    }

    /**
     * @Route("/api/getRespuesta/{id}", name="getRespuesta")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getRespuesta(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getRespuesta($id));
    }

    /**
     * @Route("/api/getRespuestasFromPregunta/{id}", name="getRespuestasFromPregunta")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getRespuestasFromPregunta(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getRespuestasFromPregunta($id));
    }

    /**
     * @Route("/api/getRespuestasFromUsuario/{id}", name="getRespuestasFromUsuario")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getRespuestasFromUsuario(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getRespuestasFromUsuario($id));
    }

    /**
     * @Route("/api/getOpcion/{id}", name="getOpcion")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getOpcion(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getOpcion($id));
    }

    /**
     * @Route("/api/createUser", name="createUser")
     * @param DataAccess $dataAccess
     * @param Request $request
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

    /**
     * @Route("/api/createPregunta", name="createPregunta")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function createPregunta(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["TEXT"])) {
            $dataAccess->createPregunta(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/createEncuesta", name="createEncuesta")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function createEncuesta(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["CONTENIDO"])) {
            $dataAccess->createEncuesta(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/createPreguntaMultiopcion", name="createPreguntaMultiopcion")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function createPreguntaMultiopcion(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["CONTENIDO"])) {
            $dataAccess->createPreguntaMultiopcion(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/createRespuesta", name="createRespuesta")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function createRespuesta(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["CONTENIDO"])) {
            $dataAccess->createRespuesta(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/followUser", name="followUser")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function followUser(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["USUARIO_QUE_SIGUE"])) {
            $dataAccess->followUser(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/reportQuestion", name="reportQuestion")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function reportQuestion(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["ID"])) {
            $dataAccess->reportQuestion(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/likeQuestion", name="likeQuestion")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function likeQuestion(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["ID"])) {
            $dataAccess->likeQuestion(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/unfollowUser", name="unfollowUser")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function unfollowUser(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["USUARIO_QUE_SIGUE"])) {
            $dataAccess->unfollowUser(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/deletePregunta/{id}", name="deletePregunta")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function deletePregunta(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->deletePregunta($id));
    }

    /**
     * @Route("/api/deleteEncuesta/{id}", name="deleteEncuesta")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function deleteEncuesta(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->deleteEncuesta($id));
    }

    /**
     * @Route("/api/deletePreguntaMultiopcion/{id}", name="deletePreguntaMultiopcion")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function deletePreguntaMultiopcion(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->deletePreguntaMultiopcion($id));
    }

    /**
     * @Route("/api/deleteRespuesta/{id}", name="deleteRespuesta")
     * @param string $id
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function deleteRespuesta(string $id, DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->deleteRespuesta($id));
    }

    /**
     * @Route("/api/addPointsToUser", name="addPointsToUser")
     * @param DataAccess $dataAccess
     * @param Request $request
     * @return string
     */
    public function addPointsToUser(DataAccess $dataAccess, Request $request)
    {
        if (!empty(json_decode($request->getContent(), true)["USERNAME"])) {
            $dataAccess->addPointsToUser(json_decode($request->getContent(), true));
            return new JsonResponse(true);
        } else {
            return new JsonResponse(false);
        }
    }

    /**
     * @Route("/api/chooseOption/{id}", name="chooseOption")
     * @param DataAccess $dataAccess
     * @param string $id
     * @return string
     */
    public function chooseOption(DataAccess $dataAccess, string $id)
    {
        return new JsonResponse($dataAccess->chooseOption($id));
    }

    /**
     * @Route("/api/getRanking", name="getRanking")
     * @param DataAccess $dataAccess
     * @return Response
     */
    public function getRanking(DataAccess $dataAccess)
    {
        return new JsonResponse($dataAccess->getRanking());
    }
}