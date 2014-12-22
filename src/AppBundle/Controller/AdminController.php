<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/20/14
 * Time: 10:32 AM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController {

    /**
     * @Route("/admin/dashboard")
     * @param Request $request
     * @return array
     * @Template("AppBundle:Admin:dashboard.html.twig")
     */
    public function dashboardAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/admin/reports")
     * @param Request $request
     * @return array
     * @Template("AppBundle:Admin:reports.html.twig")
     */
    public function reportsAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/admin/clients")
     * @param Request $request
     * @return array
     * @Template("AppBundle:Admin:clients.html.twig")
     */
    public function clientsAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/admin/users")
     * @param Request $request
     * @return array
     * @Template("AppBundle:Admin:users.html.twig")
     */
    public function usersAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/admin/invoices")
     * @param Request $request
     * @return array
     * @Template("AppBundle:Admin:invoices.html.twig")
     */
    public function invoicesAction(Request $request)
    {
        return [];
    }

} 