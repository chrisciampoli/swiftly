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

class AdminController {

    /**
     * @Route("/admin/dashboard")
     * @param Request $request
     */
    public function dashboardAction(Request $request)
    {
        echo "Found me!";
    }

    /**
     * @Route("/admin/reports")
     * @param Request $request
     */
    public function reportsAction(Request $request)
    {

    }

    /**
     * @Route("/admin/clients")
     * @param Request $request
     */
    public function clientsAction(Request $request)
    {

    }

    /**
     * @Route("/admin/users")
     * @param Request $request
     */
    public function usersAction(Request $request)
    {

    }

    /**
     * @Route("/admin/invoices")
     * @param Request $request
     */
    public function invoicesAction(Request $request)
    {

    }

} 