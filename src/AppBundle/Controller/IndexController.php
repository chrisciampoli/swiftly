<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (is_string($user)) {
            throw new \Exception("Anon dont work yo");
        }

        echo $user->hasRole('ROLE_ADMIN');

        return [
           'user' => $user
        ];
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
