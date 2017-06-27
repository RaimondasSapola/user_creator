<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/26/2017
 * Time: 3:55 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserListController extends Controller
{
    /**
     * @Route("/users", name="users")
     */
    public function showAction(){
        $user = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('AppBundle:User')
                    ->allUsers();
        $data['users'] = $user;
        return $this->render('users/index.html.twig', $data);
    }
    /**
     * @Route("/search", name="search")
     * @Method("POST")
     */
    public function searchAction(Request $request){
        $search = $request->request->get('searchText');
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')
            ->searchUsers($search);

        $data['users'] = $users;

        return new JsonResponse($data);
    }
}