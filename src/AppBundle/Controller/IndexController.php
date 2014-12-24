<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $securityContext = $this->container->get('security.context');
        $router = $this->container->get('router');

        if ($securityContext->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($router->generate('app_admin_dashboard'), 307);
        }

        if ($securityContext->isGranted('ROLE_MANAGER')) {
            return new RedirectResponse($router->generate('app_manager_dashboard'), 307);
        }

        if ($securityContext->isGranted('ROLE_USER')) {
            return new RedirectResponse($router->generate('app_employee_dashboard'), 307);
        }

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
