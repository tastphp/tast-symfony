<?php

namespace AppDemo\Common;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    function registerService($name)
    {
        return $this->get('service_kernel')->registerService($name);
    }
}