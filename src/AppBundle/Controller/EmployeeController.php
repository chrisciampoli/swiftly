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

class EmployeeController
{
    /**
     * @Route("/employee/dashboard")
     */
    public function dashboardAction()
    {
        echo "Found me!";
    }

} 