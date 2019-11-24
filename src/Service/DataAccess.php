<?php

namespace App\Service;

class DataAccess extends BaseDataAccess {
    public function getUser(string $user) {
        return parent::executeSQL("SELECT * FROM usuario WHERE USERNAME = :user;", ["user" => $user])->fetch();
    }

    public function getPregunta(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function getPreguntasFromUser(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta WHERE USERID = :id", ["id" => $id])->fetchAll();
    }

    public function getFeedPreguntas(string $id) {
        return parent::executeSQL("SELECT * 
                                       FROM pregunta 
                                       WHERE pregunta.USERID IN (SELECT seguidores.USUARIO_SEGUIDO
                                                        FROM seguidores
                                                        WHERE seguidores.USUARIO_QUE_SIGUE = :id)
                                       AND pregunta.ID NOT IN (SELECT respuesta.PREGUNTAID
                                                      FROM respuesta
                                                      WHERE respuesta.PREGUNTAID = pregunta.ID
                                                      AND respuesta.USERID = :id);", ["id" => $id])->fetchAll();
    }

    public function getEncuesta(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_encuesta WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function getEncuestasFromUser(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_encuesta WHERE USERID = :id", ["id" => $id])->fetchAll();
    }

    public function getFeedEncuestas(string $id) {
        return parent::executeSQL("SELECT * 
                                       FROM pregunta_encuesta 
                                       WHERE pregunta_encuesta.USERID IN (SELECT seguidores.USUARIO_SEGUIDO
                                                        FROM seguidores
                                                        WHERE seguidores.USUARIO_QUE_SIGUE = :id)", ["id" => $id])->fetchAll();
    }

    public function getFeedEncuestasOptions(string $id) {
        return parent::executeSQL("SELECT *
                                       FROM opcion
                                       WHERE opcion.ID IN (
                                           SELECT pregunta_encuesta.OPCION_UNO
                                           FROM pregunta_encuesta 
                                           WHERE pregunta_encuesta.USERID IN (
                                               SELECT seguidores.USUARIO_SEGUIDO
                                               FROM seguidores
                                               WHERE seguidores.USUARIO_QUE_SIGUE = :id))
                                       OR opcion.ID IN (
                                           SELECT pregunta_encuesta.OPCION_DOS
                                           FROM pregunta_encuesta 
                                           WHERE pregunta_encuesta.USERID IN (
                                               SELECT seguidores.USUARIO_SEGUIDO
                                               FROM seguidores
                                               WHERE seguidores.USUARIO_QUE_SIGUE = :id))", ["id" => $id])->fetchAll();
    }

    public function getPreguntaMultiopcion(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_opciones WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function getPreguntasMultiopcionFromUser(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_opciones WHERE USERID = :id", ["id" => $id])->fetchAll();
    }

    public function getFeedPreguntasMultiopcion(string $id) {
        return parent::executeSQL("SELECT * 
                                       FROM pregunta_opciones 
                                       WHERE pregunta_opciones.USERID IN (SELECT seguidores.USUARIO_SEGUIDO
                                                        FROM seguidores
                                                        WHERE seguidores.USUARIO_QUE_SIGUE = :id)", ["id" => $id])->fetchAll();
    }

    public function getFeedPreguntasMultiopcionOptions(string $id) {
        return parent::executeSQL("SELECT *
                                       FROM opcion
                                       WHERE opcion.ID IN (
                                           SELECT pregunta_opciones.OPCION_UNO
                                           FROM pregunta_opciones 
                                           WHERE pregunta_opciones.USERID IN (
                                               SELECT seguidores.USUARIO_SEGUIDO
                                               FROM seguidores
                                               WHERE seguidores.USUARIO_QUE_SIGUE = :id))
                                       OR opcion.ID IN (
                                           SELECT pregunta_opciones.OPCION_DOS
                                           FROM pregunta_opciones 
                                           WHERE pregunta_opciones.USERID IN (
                                               SELECT seguidores.USUARIO_SEGUIDO
                                               FROM seguidores
                                               WHERE seguidores.USUARIO_QUE_SIGUE = :id))
                                       OR opcion.ID IN (
                                           SELECT pregunta_opciones.OPCION_TRES
                                           FROM pregunta_opciones 
                                           WHERE pregunta_opciones.USERID IN (
                                               SELECT seguidores.USUARIO_SEGUIDO
                                               FROM seguidores
                                               WHERE seguidores.USUARIO_QUE_SIGUE = :id))", ["id" => $id])->fetchAll();
    }

    public function getSiguiendo(string $username) {
        return parent::executeSQL("SELECT * 
                                       FROM usuario 
                                       WHERE usuario.USERNAME IN (SELECT seguidores.USUARIO_SEGUIDO
                                                        FROM seguidores
                                                        WHERE seguidores.USUARIO_QUE_SIGUE = :username)",
            ["username" => $username])->fetchAll();
    }

    public function getSeguidores(string $username) {
        return parent::executeSQL("SELECT * 
                                       FROM usuario 
                                       WHERE usuario.USERNAME IN (SELECT seguidores.USUARIO_QUE_SIGUE
                                                        FROM seguidores
                                                        WHERE seguidores.USUARIO_SEGUIDO = :username)",
            ["username" => $username])->fetchAll();
    }

    public function getRespuesta(string $id) {
        return parent::executeSQL("SELECT * FROM respuesta WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function getRespuestasFromPregunta(string $id) {
        return parent::executeSQL("SELECT * FROM respuesta WHERE PREGUNTAID = :id", ["id" => $id])->fetchAll();
    }

    public function getRespuestasFromUsuario(string $id) {
        return parent::executeSQL("SELECT * FROM respuesta WHERE USERID = :id", ["id" => $id])->fetchAll();
    }

    public function getOpcion(string $id) {
        return parent::executeSQL("SELECT * FROM opcion WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function createUser(array $data) {
        return parent::executeSQL("INSERT INTO usuario(USERNAME, NAME, PASSWORD, EMAIL, COUNTRY, PROVINCE, ROLE) 
                                    VALUES (:username, :nombre, :pass, :email, :country, :province, 1);",
                                ["username" => $data["USERNAME"], "nombre" => $data["NAME"], "pass" => $data["PASSWORD"],
                                    "email" => $data["EMAIL"], "country" => $data["COUNTRY"], "province" => $data["PROVINCE"]]);
    }

    public function createPregunta(array $data) {
        return parent::executeSQL("INSERT INTO pregunta(TEXT, USERID, REPORTS, LIKES) 
                                    VALUES (:TEXT_, :USERID, :REPORTS, :LIKES);",
            ["TEXT_" => $data["TEXT"], "USERID" => $data["USERID"], "REPORTS" => $data["REPORTS"],
                "LIKES" => $data["LIKES"]]);
    }

    private function createOpcion($enunciado, $respuesta_correcta) {
        parent::executeSQL("INSERT INTO opcion(CONTENIDO, OPCION_CORRECTA, VECES_SELECCIONADAS) 
                                    VALUES (:CONTENIDO, :OPCION_CORRECTA, :VECES_SELECCIONADAS);",
            ["CONTENIDO" => $enunciado, "OPCION_CORRECTA" => $respuesta_correcta, "VECES_SELECCIONADAS" => 0]);
        return parent::getlastInsertId();
    }

    public function createEncuesta(array $data) {
        parent::executeSQL("INSERT INTO pregunta_encuesta(CONTENIDO, OPCION_UNO, OPCION_DOS, USERID, LIKES, REPORTS)
                                    VALUES (:CONTENIDO, :OPCION_UNO, :OPCION_DOS, :USERID, :LIKES, :REPORTS);",
            ["CONTENIDO" => $data["CONTENIDO"], "OPCION_UNO" => $this->createOpcion($data["OPCION_UNO"], 0),
                "OPCION_DOS" => $this->createOpcion($data["OPCION_DOS"], 0), "USERID" => $data["USERID"],
                "LIKES" => $data["LIKES"], "REPORTS" => $data["REPORTS"]]);
    }

    public function createPreguntaMultiopcion(array $data) {
        parent::executeSQL("INSERT INTO pregunta_opciones(CONTENIDO, OPCION_UNO, OPCION_DOS, OPCION_TRES, USERID, LIKES, REPORTS)
                                    VALUES (:CONTENIDO, :OPCION_UNO, :OPCION_DOS, :OPCION_TRES, :USERID, :LIKES, :REPORTS);",
            ["CONTENIDO" => $data["CONTENIDO"], "OPCION_UNO" => $this->createOpcion($data["OPCION_UNO"], ($data["RESPUESTA_CORRECTA"] == "1") ? 1 : 0),
                "OPCION_DOS" => $this->createOpcion($data["OPCION_DOS"], ($data["RESPUESTA_CORRECTA"] == "2") ? 1 : 0),
                "OPCION_TRES" => $this->createOpcion($data["OPCION_TRES"], ($data["RESPUESTA_CORRECTA"] == "3") ? 1 : 0), "USERID" => $data["USERID"],
                "LIKES" => $data["LIKES"], "REPORTS" => $data["REPORTS"]]);
    }

    public function createRespuesta(array $data) {
        return parent::executeSQL("INSERT INTO respuesta(CONTENIDO, USERID, PREGUNTAID, anonymous)
                                    VALUES (:CONTENIDO, :USERID, :PREGUNTAID, :anonymous);",
            ["CONTENIDO" => $data["CONTENIDO"], "USERID" => $data["USERID"], "PREGUNTAID" => $data["PREGUNTAID"],
                "anonymous" => $data["anonymous"]]);
    }

    public function followUser(array $data) {
        return parent::executeSQL("INSERT INTO seguidores(USUARIO_QUE_SIGUE, USUARIO_SEGUIDO)
                                    VALUES (:USUARIO_QUE_SIGUE, :USUARIO_SEGUIDO);",
            ["USUARIO_QUE_SIGUE" => $data["USUARIO_QUE_SIGUE"], "USUARIO_SEGUIDO" => $data["USUARIO_SEGUIDO"]]);
    }

    public function reportQuestion(array $data) {
        if ($data["TYPE"] == "1") {
            return parent::executeSQL("UPDATE pregunta SET REPORTS = REPORTS + 1 WHERE ID = :ID;", ["ID" => $data["ID"]]);
        }
        if ($data["TYPE"] == "2") {
            return parent::executeSQL("UPDATE pregunta_encuesta SET REPORTS = REPORTS + 1 WHERE ID = :ID;", ["ID" => $data["ID"]]);
        }
        if ($data["TYPE"] == "3") {
            return parent::executeSQL("UPDATE pregunta_opciones SET REPORTS = REPORTS + 1 WHERE ID = :ID;", ["ID" => $data["ID"]]);
        }
    }

    public function likeQuestion(array $data) {
        if ($data["TYPE"] == "1") {
            return parent::executeSQL("UPDATE pregunta SET LIKES = LIKES + 1 WHERE ID = :ID;", ["ID" => $data["ID"]]);
        }
        if ($data["TYPE"] == "2") {
            return parent::executeSQL("UPDATE pregunta_encuesta SET LIKES = LIKES + 1 WHERE ID = :ID;", ["ID" => $data["ID"]]);
        }
        if ($data["TYPE"] == "3") {
            return parent::executeSQL("UPDATE pregunta_opciones SET LIKES = LIKES + 1 WHERE ID = :ID;", ["ID" => $data["ID"]]);
        }
    }

    public function unfollowUser(array $data) {
        return parent::executeSQL("DELETE FROM seguidores WHERE USUARIO_QUE_SIGUE = :USUARIO_QUE_SIGUE 
                         AND USUARIO_SEGUIDO = :USUARIO_SEGUIDO;",
            ["USUARIO_QUE_SIGUE" => $data["USUARIO_QUE_SIGUE"], "USUARIO_SEGUIDO" => $data["USUARIO_SEGUIDO"]]);
    }

    public function deletePregunta(string $id) {
        parent::executeSQL("DELETE FROM pregunta WHERE ID = :ID;", ["ID" => $id]);
        return true;
    }

    public function deleteEncuesta(string $id) {
        parent::executeSQL("DELETE FROM pregunta_encuesta WHERE ID = :ID;", ["ID" => $id]);
        return true;
    }

    public function deletePreguntaMultiopcion(string $id) {
        parent::executeSQL("DELETE FROM pregunta_opciones WHERE ID = :ID;", ["ID" => $id]);
        return true;
    }

    public function deleteRespuesta(string $id) {
        parent::executeSQL("DELETE FROM respuesta WHERE ID = :ID;", ["ID" => $id]);
        return true;
    }

    public function addPointsToUser(array $data) {
        parent::executeSQL("UPDATE usuario SET POINTS = POINTS + :POINTS WHERE USERNAME = :USERNAME;",
            ["POINTS" => $data["POINTS"], "USERNAME" => $data["USERNAME"]]);
        return true;
    }

    public function chooseOption(string $id)
    {
        parent::executeSQL("UPDATE opcion SET VECES_SELECCIONADAS = VECES_SELECCIONADAS + 1 WHERE ID = :ID", ["ID" => $id]);
        return true;
    }

    public function getRanking()
    {
        return parent::executeSQL("SELECT usuario.USERNAME, usuario.POINTS FROM usuario ORDER BY POINTS DESC");
    }
}