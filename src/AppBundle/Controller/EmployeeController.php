<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 12/20/14
 * Time: 10:33 AM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController
{
    /**
     * @Route("/employee/dashboard")
     * @param Request $request
     */
    public function dashboardAction(Request $request)
    {
        echo "Found me!";
    }

    /**
     * @Route("/employee/profile")
     * @param Request $request
     */
    public function profileAction(Request $request)
    {

    }

    /**
     * @Route("/employee/giveup")
     * @param Request $request
     */
    public function giveupAction(Request $request)
    {

    }

    /**
     * @Route("/employee/swap")
     * @param Request $request
     */
    public function swapAction(Request $request)
    {

    }

    /**
     * @Route("/employee/availability")
     * @param Request $request
     */
    public function availabilityAction(Request $request)
    {

    }

} 