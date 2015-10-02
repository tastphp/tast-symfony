<?php

namespace AppDemo\Service\User\Dao\Impl;

use AppDemo\Common\BaseDao;
use AppDemo\Service\User\Dao\UserDao;


class UserDaoImpl extends BaseDao implements UserDao
{
    public function getUser($id)
    {
        $conn = $this->getConnection();
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder
            ->select('id', 'username')
            ->from('xujiajun_user')
            ->where('id = ?')
            ->setParameter(0, $id);

        $user = $queryBuilder->execute()->fetchAll();

        return $user[0];

    }
}

