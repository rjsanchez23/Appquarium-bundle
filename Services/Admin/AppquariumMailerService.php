<?php namespace AppquariumBundle\Services\Admin;


use Swift_Mailer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AppquariumMailerService {

    private $mailer;
    /*
     * Posible componente ha utilizar si queremos generar links hacia nuestra plataforma en el cuerpo del mensaje
     *
     */
    private $router;
    private $parameters;

    public function __construct(Swift_Mailer $mailer, UrlGeneratorInterface $router, array $parameters)
    {
        $this->mailer = $mailer;
        $this->router = $router;
        $this->parameters = $parameters;
    }

    public function sendEmailMessage($user, $message)
    {
        $senderEmail = $this->parameters['sender']['email'];
        $senderName = $this->parameters['sender']['name'];
        $senderSubject = is_array($user) ? $this->parameters['sender']['subject'] : $this->parameters['sender']['private-subject'];
        $this->sendMessage($user, $message, $senderName, $senderEmail, $senderSubject);
    }

    public function sendNewsletterMail($users, $message)
    {
        $receivers = [];

        if(empty($users))
        {
            throw new \RuntimeException('No existen usuarios subscritos a la newsletter');
        }

        foreach ($users as $user)
        {
            if(!$user instanceof UserInterface)
            {
                throw new \InvalidArgumentException('El email no ha podido enviarse correctamente, el usuario debe cumplir con el formato especificado');
            }

            $receivers[ $user->getEmail() ] = $user->getName() . ' ' . $user->getSurname();
        }

        $this->sendEmailMessage($receivers, $message);

    }

    private function sendMessage($receiver, $senderMessage, $senderName, $senderEmail, $senderSubject)
    {
        $sendTo = $this->resolveSendToField($receiver);

        $message = \Swift_Message::newInstance()
            ->setSubject( $senderSubject )
            ->setFrom( [ $senderEmail => $senderName ] )
            ->setTo( $sendTo )
            ->setBody($senderMessage, 'text/html');

        $this->mailer->send( $message );
    }

    private function resolveSendToField($receiver)
    {
        if(is_array($receiver)) return $receiver;

        $receiverEmail = $receiver->getEmail();
        $receiverName = $receiver->getName() . ' ' . $receiver->getSurname();
        $sendTo = [ $receiverEmail => $receiverName ];

        return $sendTo;
    }

} 