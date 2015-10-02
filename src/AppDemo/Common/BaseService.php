<?php

namespace AppDemo\Common;

class BaseService
{
    public function registerDao($name)
    {
        return $this->getKernel()->registerDao($name);
    }

    protected function getKernel()
    {
        return ServiceKernel::instance();
    }
}