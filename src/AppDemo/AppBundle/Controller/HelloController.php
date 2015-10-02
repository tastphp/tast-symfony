<?php

namespace AppDemo\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppDemo\Common\BaseController;

class HelloController extends BaseController
{
    /**
     * @return Response
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        $uid = $request->get('uid') ? : 4;
        $user = $this->getUserService()->getUser($uid);
        return $this->render(
            'AppBundle:hello:index.html.twig',
            ['user' => $user]
        );
    }

    private function getUserService()
    {
        return $this->registerService('User.UserService');
    }
}