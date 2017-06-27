<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/24/2017
 * Time: 2:48 PM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\Type\RegistrationFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationsController extends Controller
{

    public function __construct(){
    }
    /**
     * @Route("/add_user", name="add_user")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showIndexAction(Request $request){
        $user = new User();

        $form = $this->generateForm($user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $password = $this
                ->get('security.password_encoder')
                ->encodePassword(
                    $user,
                    $user->getPlainPassword()
                )
            ;

            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'New user added successfuly!');

            unset($user);
            unset($form);
            $user = new User();
            $form = $this->generateForm($user);

        }
        $data['registration_form'] = $form->createView();
        return $this->render(':users:new-user.html.twig', $data);
    }

    /**
     * @param $user
     * @return \Symfony\Component\Form\Form
     */
    private function generateForm($user)
    {
        $form = $this->createForm(RegistrationFormType::class, $user, [
            'action' => $this->generateUrl('add_user'),
        ]);
        return $form;
    }
}