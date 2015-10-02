<?php

namespace AppDemo\Service\User\Impl;

use AppDemo\Common\BaseService;
use AppDemo\Service\User\UserService;

use AppDemo\Service\User\Event\UserListener;
use Symfony\Component\EventDispatcher\EventDispatcher;

class UserServiceImpl extends BaseService implements UserService
{
    public function getUser($id)
    {
        return $this->getUserDao()->getUser($id);
    }

    private function getUserDao()
    {
        return $this->registerDao('User.UserDao');
    }
}