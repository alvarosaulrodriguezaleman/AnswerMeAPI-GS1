<?php

namespace App\Service;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Statement;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

abstract class BaseDataAccess
{

    private $connection;
    private $security;
    private $requestStack;

    public function __construct(Connection $connection, Security $security, RequestStack $requestStack)
    {
        $this->connection = $connection;
        $this->security = $security;
        $this->requestStack = $requestStack;
    }

    /**
     * @param string $sql
     * @param array $args
     * @param bool $log
     * @return Statement
     */
    public function executeSQL(string $sql = "", array $args = [], $log = true) {

        try {
            $stmt = $this->connection->prepare($sql);
            foreach ($args as $clave => $valor) {
                $stmt->bindValue($clave, $valor);
            }
            return $stmt->execute() ? $stmt : false;
        } catch (DBALException $e) {
            dump($e);
            return null;
        }
    }

    /**
     * @return string
     */
    public function getlastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
