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

    public function getEncuesta(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_encuesta WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function getEncuestasFromUser(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_encuesta WHERE USERID = :id", ["id" => $id])->fetchAll();
    }

    public function getPreguntaMultiopcion(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_opciones WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function getPreguntasMultiopcionFromUser(string $id) {
        return parent::executeSQL("SELECT * FROM pregunta_opciones WHERE USERID = :id", ["id" => $id])->fetchAll();
    }

    public function getSiguiendo(string $username) {
        return parent::executeSQL("SELECT USUARIO_SEGUIDO FROM seguidores WHERE USUARIO_QUE_SIGUE = :username",
            ["username" => $username])->fetchAll();
    }

    public function getSeguidores(string $username) {
        return parent::executeSQL("SELECT USUARIO_QUE_SIGUE FROM seguidores WHERE USUARIO_SEGUIDO = :username",
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
        return parent::executeSQL("INSERT INTO pregunta(TEXT, USERID, REPORTS, LIKES, ANONYMOUS) 
                                    VALUES (:TEXT_, :USERID, :REPORTS, :LIKES, :ANONYMOUS);",
            ["TEXT_" => $data["TEXT"], "USERID" => $data["USERID"], "REPORTS" => $data["REPORTS"],
                "LIKES" => $data["LIKES"], "ANONYMOUS" => $data["ANONYMOUS"]]);
    }

    private function createOpcion($enunciado, $respuesta_correcta) {
        parent::executeSQL("INSERT INTO opcion(CONTENIDO, OPCION_CORRECTA, VECES_SELECCIONADAS) 
                                    VALUES (:CONTENIDO, :OPCION_CORRECTA, :VECES_SELECCIONADAS);",
            ["CONTENIDO" => $enunciado, "OPCION_CORRECTA" => $respuesta_correcta, "VECES_SELECCIONADAS" => 0]);
        return parent::getlastInsertId();
    }

    public function createEncuesta(array $data) {
        parent::executeSQL("INSERT INTO pregunta_encuesta(CONTENIDO, OPCION_UNO, OPCION_DOS, USERID)
                                    VALUES (:CONTENIDO, :OPCION_UNO, :OPCION_DOS, :USERID);",
            ["CONTENIDO" => $data["CONTENIDO"], "OPCION_UNO" => $this->createOpcion($data["OPCION_UNO"], ($data["RESPUESTA_CORRECTA"] == "1") ? 1 : 0),
                "OPCION_DOS" => $this->createOpcion($data["OPCION_DOS"], ($data["RESPUESTA_CORRECTA"] == "2") ? 1 : 0), "USERID" => $data["USERID"]]);
    }

    public function createPreguntaMultiopcion(array $data) {
        parent::executeSQL("INSERT INTO pregunta_opciones(CONTENIDO, OPCION_UNO, OPCION_DOS, OPCION_TRES, USERID)
                                    VALUES (:CONTENIDO, :OPCION_UNO, :OPCION_DOS, :OPCION_TRES, :USERID);",
            ["CONTENIDO" => $data["CONTENIDO"], "OPCION_UNO" => $this->createOpcion($data["OPCION_UNO"], ($data["RESPUESTA_CORRECTA"] == "1") ? 1 : 0),
                "OPCION_DOS" => $this->createOpcion($data["OPCION_DOS"], ($data["RESPUESTA_CORRECTA"] == "2") ? 1 : 0),
                "OPCION_TRES" => $this->createOpcion($data["OPCION_TRES"], ($data["RESPUESTA_CORRECTA"] == "3") ? 1 : 0), "USERID" => $data["USERID"]]);
    }

    public function createRespuesta(array $data) {
        return parent::executeSQL("INSERT INTO respuesta(CONTENIDO, USERID, PREGUNTAID)
                                    VALUES (:CONTENIDO, :USERID, :PREGUNTAID);",
            ["CONTENIDO" => $data["CONTENIDO"], "USERID" => $data["USERID"], "PREGUNTAID" => $data["PREGUNTAID"]]);
    }

    public function followUser(array $data) {
        return parent::executeSQL("INSERT INTO seguidores(USUARIO_QUE_SIGUE, USUARIO_SEGUIDO)
                                    VALUES (:USUARIO_QUE_SIGUE, :USUARIO_SEGUIDO);",
            ["USUARIO_QUE_SIGUE" => $data["USUARIO_QUE_SIGUE"], "USUARIO_SEGUIDO" => $data["USUARIO_SEGUIDO"]]);
    }
}