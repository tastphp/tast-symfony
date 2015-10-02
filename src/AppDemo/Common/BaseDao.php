<?php

namespace AppDemo\Common;

class BaseDao
{
    protected $connection;

    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    protected function getConnection()
    {
        return $this->connection;
    }
}