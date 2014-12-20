<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        $user = $this->container->get('fos_user.user_manager')
            ->findUserByUsername('chris');

        var_dump($user);die;
        return $this->render('default/index.html.twig');
    }
}
