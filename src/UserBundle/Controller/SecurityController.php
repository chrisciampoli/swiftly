<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/21/14
 * Time: 9:17 PM
 */

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;

class SecurityController extends BaseController {
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function loginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $securityContext = $this->container->get('security.context');
        $router = $this->container->get('router');

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = null;
        }

        if ($securityContext->isGranted('ROLE_ADMIN')) {
            return new RedirectResponse($router->generate('app_admin_dashboard'), 307);
        }

        if ($securityContext->isGranted('ROLE_MANAGER')) {
            return new RedirectResponse($router->generate('app_manager_dashboard'), 307);
        }

        if ($securityContext->isGranted('ROLE_USER')) {
            return new RedirectResponse($router->generate('app_employee_dashboard'), 307);
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        $csrfToken = $this->has('form.csrf_provider')
            ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
            : null;


        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ));

    }
} 