<?php


namespace App\Classe;

use App\Entity\Order;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class AutoMail
{
    private $mailer;
    private $email;


    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    // Fonction qui envoi notre confirmation d'inscription
    public function sendRegisterSuccess($recipientMail, $recipientFullName)
    {
        $this->email = new TemplatedEmail();
        $this->email->from('contact@villagegreen.com') // Mettre ici le bon nom de domaine une fois en prode
        ->to($recipientMail) // Email du destinataire
        ->subject('Votre inscription sur villagegreen.com')
            ->htmlTemplate('email/register_success.html.twig')
            ->context([
                'recipientMail' => $recipientMail,
                'recipientFullName' => $recipientFullName
            ]);
        $this->mailer->send($this->email);
    }

    // Fonction qui envoie une confirmation ou un abandon de commande selon si la commande est payée
    public function sendOrderStatus($recipientMail, $recipientFullName, Order $order)
    {
        $this->email = new TemplatedEmail();
        $this->email->from('contact@villagegreen.com') // Mettre ici le bon nom de domaine une fois en prode
        ->to($recipientMail);// Email du destinataire
        if($order->getIsPaid() == 0)
        {
            $this->email->subject('Abandon de votre commande n°'.$order->getReference() .' sur villagegreen.com')
            ->htmlTemplate('email/order_status.html.twig')
            ->context([
                'recipientMail' => $recipientMail,
                'recipientFullName' => $recipientFullName,
                'orderReference' => $order->getReference(),
                'orderStatus' => $order->getIsPaid()
            ]);
        }
        else
        {
            $this->email->subject('Confirmation de votre commande n°'.$order->getReference().'  sur villagegreen.com')
                ->htmlTemplate('email/order_status.html.twig')
                ->context([
                    'recipientMail' => $recipientMail,
                    'recipientFullName' => $recipientFullName,
                    'orderReference' => $order->getReference(),
                    'orderPrice' => $order->getTotal(),
                    'orderStatus' => $order->getIsPaid()
                ]);
        }

            $this->mailer->send($this->email);
    }
}