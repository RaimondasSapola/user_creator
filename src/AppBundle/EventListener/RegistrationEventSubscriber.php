<?php
/**
 * Created by IntelliJ IDEA.
 * User: Raimondas
 * Date: 6/24/2017
 * Time: 3:43 PM
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;

class RegistrationEventSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(){
        return array(
            'postPersist',
            'postUpdate',
        );
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof User) {

            $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('99emailsaday@gmail.com')
                ->setPassword('slaptazodisgeras')
            ;

            $email_body = '<h1>Hello</h1><br>
                <span>You may log in <a href="'.$_SERVER['SERVER_NAME'].'">HERE </a>with following credentials:</span><br>
                <b>Email: </b> '.$entity->getEmail().'<br>
                <b>Password: </b> '.$entity->getPlainPassword().'<br>';

            $mailer = new \Swift_Mailer($transport);
            $message = new \Swift_Message();
                $message->setSubject('New Account Details')
                    ->setFrom('99emailsaday@gmail.com')
                    ->setTo($entity->getEmail())
                    ->setBody($email_body, 'text/html');
            $mailer->send($message);
        }
    }
}