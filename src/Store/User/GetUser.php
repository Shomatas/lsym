<?php

namespace App\Store\User;

use App\Domain\User\Store\DTO\UserDTO;
use App\Domain\User\Store\GetUserInterface;
use App\Domain\User\Store\GetUserTestInterface;
use App\Store\Connection\Db;

class GetUser implements GetUserTestInterface, GetUserInterface
{

    public function get(int $id): UserDTO
    {
        $db = Db::getInstance();
        $tableName = \App\Store\Connection\Db::DB_TABLE_USER_NAME;

        $query = "SELECT * FROM {$tableName} WHERE id=:id";
        $data = [
            "id" => $id,
        ];


        $data = $db->request($query, $data);
        return new UserDTO($data["id"], $data["login"], $data["password"]);
    }

    public function getAll(): array
    {
        $db = Db::getInstance();
        $tableName = $db::DB_TABLE_USER_NAME;

        $query = "SELECT * FROM {$tableName}";
        $data = [];

        return $db->request($query, $data, true);
    }
}