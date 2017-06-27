<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/23/2017
 * Time: 6:06 PM
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\LoginFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller{

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils){

        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('home');
        }

        $data['error'] = $authUtils->getLastAuthenticationError();

        $form = $this->createForm(LoginFormType::class, null, [
            'action' => $this->generateUrl('login'),
            'attr' => [
                'class' => 'login_form',
            ]
        ]);
        $data['login_form'] = $form->createView();
        return $this->render('security/login.html.twig', $data);
    }
    /**
     * @Route("/logout")
     */
    public function logoutAction(){
        throw new \RuntimeException('This Should not be called directly');
    }
}