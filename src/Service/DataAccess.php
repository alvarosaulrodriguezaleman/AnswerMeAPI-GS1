<?php

namespace App\Service;

class DataAccess extends BaseDataAccess {
    public function getUser(string $user) {
        return parent::executeSQL("SELECT * FROM USUARIO WHERE USERNAME = :user;", ["user" => $user])->fetch();
    }

    public function getPregunta(string $id) {
        return parent::executeSQL("SELECT * FROM PREGUNTA WHERE ID = :id", ["id" => $id])->fetch();
    }

    public function createUser(array $data) {
        return parent::executeSQL("INSERT INTO USUARIO(USERNAME, NAME, PASSWORD, EMAIL, COUNTRY, PROVINCE, ROLE) 
                                    VALUES (:username, :nombre, :pass, :email, :country, :province, 1);",
                                ["username" => $data["USERNAME"], "nombre" => $data["NAME"], "pass" => $data["PASSWORD"],
                                    "email" => $data["EMAIL"], "country" => $data["COUNTRY"], "province" => $data["PROVINCE"]]);
    }
}