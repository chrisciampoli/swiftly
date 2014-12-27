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

class ManagerController {

    /**
     * @Route("/manager/dashboard")
     * @param Request $request
     * @return array
     * @Template()
     */
    public function dashboardAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/manager/shifts")
     * @param Request $request
     */
    public function shiftsAction(Request $request)
    {

    }

    /**
     * @Route("/manager/locations")
     * @param Request $request
     */
    public function locationsAction(Request $request)
    {

    }

    /**
     * @Route("/manager/positions")
     * @param Request $request
     */
    public function positionsAction(Request $request)
    {

    }

    /**
     * @Route("/manager/employees")
     * @param Request $request
     */
    public function employeesAction(Request $request)
    {

    }

    /**
     * @Route("/manager/autoSchedule")
     * @param Request $request
     */
    public function autoScheduleAction(Request $request)
    {

    }

    /**
     * @Route("/manager/companySchedule")
     * @param Request $request
     */
    public function companyScheduleAction(Request $request)
    {

    }

} 