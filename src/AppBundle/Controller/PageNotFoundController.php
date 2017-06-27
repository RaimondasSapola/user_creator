<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/27/2017
 * Time: 10:04 AM
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageNotFoundController extends Controller
{
    public function pageNotFoundAction(){
        return $this->render(':error:page-not-found.html.twig');
    }
}