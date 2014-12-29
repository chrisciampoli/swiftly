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

        if ($securityContext->isGranted('ROLE_EMPLOYEE')) {
            return new RedirectResponse($router->generate('app_employee_dashboard'), 307);
        }

        if ($securityContext->isGranted('ROLE_USER')) {
            return new RedirectResponse($router->generate('app_index_wait'), 307);
        }

        return [
           'user' => $user
        ];
    }

    /**
     * @Route("/wait")
     */
    public function waitAction()
    {
        return 'Sorry';
    }

}

