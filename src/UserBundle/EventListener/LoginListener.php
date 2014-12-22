<?php
// src/UserBundle/EventListener/LoginListener.php

namespace UserBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine; // for Symfony 2.1.0+
// use Symfony\Bundle\DoctrineBundle\Registry as Doctrine; // for Symfony 2.0.x

/**
 * Custom login listener.
 */
class LoginListener
{
    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /** @var \Symfony\Component\DependencyInjection\ContainerInterface */
    private $container;

    /**
     * Constructor
     *
     * @param SecurityContext $securityContext
     * @param Doctrine        $doctrine
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine, ContainerInterface $container)
    {
        $this->securityContext = $securityContext;
        $this->em              = $doctrine->getEntityManager();
        $this->container       = $container;
    }

    /**
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $request = $event->getRequest();

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            // user is logged in
            if ($this->securityContext->isGranted('ROLE_ADMIN')) {
                $request->request->set('_target_path', '/admin/dashboard');
                return $request;
            }

            if ($this->securityContext->isGranted('ROLE_MANAGER')) {
                $request->request->set('_target_path', '/manager/dashboard');
                return $request;
            }

            if ($this->securityContext->isGranted('ROLE_EMPLOYEE')) {
                $request->request->set('_target_path', '/employee/dashboard');
                return $request;
            }
        }

        if ($this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            // user has logged in using remember_me cookie

        }

        // do some other magic here
        $user = $event->getAuthenticationToken()->getUser();

        // ...
    }
}