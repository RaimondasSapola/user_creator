<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/24/2017
 * Time: 2:12 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller{

    /**
     * @Route("/", name="home")
     */
    public function showIndexAction(){
        return $this->render('home/home.html.twig');
    }

}