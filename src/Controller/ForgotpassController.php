<?php

// src/Controller/ForgotpassController.php

namespace App\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mime\Email;
use Symfony\Component\VarDumper\VarDumper;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Doctrine\ORM\EntityManagerInterface;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
class ForgotpassController extends AbstractController
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/forgotpass', name: 'app_forgotpass')]
    public function index(Request $request, UserRepository $userRepository , MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            // Get the email from the form submission
            $email = $request->request->get('_username');
            if(!$request->request->get('Verify_code')){
            // Find the user by email
            $user = $userRepository->findByEmail($email);

            if ($user) {
                // Generate a verification code (6 random numbers)
                $verificationCode = mt_rand(100000, 999999);

                // Save the verification code to the user entity (adjust the property name accordingly)
              //  $user->setVerificationCode($verificationCode);

                // Send the email with the verification code
                //$this->sendVerificationEmail($email, $verificationCode );
                $this->sendVerificationEmail($verificationCode,$email);

                // Persist the changes to the database
               // $entityManager = $this->getDoctrine()->getManager();
                //$entityManager->flush();

                // Render the template with the verification code and enable the input
                return $this->render('forgotpass/index.html.twig', [
                    'verificationCode' => $verificationCode,
                    'enableVerifyCodeInput' => true,
                    'email' => $email,
                ]);
            } else {
                // Handle the case where the user is not found
                // You may want to display an error message or redirect to a different page
                // For now, we'll redirect to the same page
                return $this->redirectToRoute('app_forgotpass');
            }
        }else{
            if($request->request->get('Verify_code')==$request->request->get('code')){
                return $this->render('security/resetpass.html.twig', [
                 'email'=> $request->request->get('email')
                ]);
                
               }else{
                return $this->redirectToRoute('app_forgotpass');
    
               }
        }
        }

        // Render the initial form
        return $this->render('forgotpass/index.html.twig', [
            'enableVerifyCodeInput' => false,
        ]);
    }


    #[Route('/checkCode', name: 'app_reset_pass')]
    public function checkCode(Request $request ,UserRepository $userRepository,UserPasswordEncoderInterface $passwordEncoder , EntityManagerInterface $entityManager){
        $request->request->get('password');
        $request->request->get('cpassword');
        if($request->request->get('password') == $request->request->get('cpassword')){
            $email= $request->request->get('email');
            $password= $request->request->get('password');
            $user = $userRepository->findByEmail($email);

            if ($user) {

                
                $user->setMdp($password);
    
                // Persist the changes
                try {
                    $entityManager->persist($user);
                    $entityManager->flush();
                    return $this->redirectToRoute('app_login');
                } catch (\Exception $e) {
                    // Handle or log the exception
                    // For debugging purposes, you can also output the exception message
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
              

            }else{
                echo "not found";
            }

        }else{
            return $this->render('security/resetpass.html.twig', [
           
            ]);
        }
    }
    public function sendVerificationEmail($verificationCode,$emailTo): void
    {
        
       
            $mail = new PHPMailer(true);
            try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // You can set this to SMTP::DEBUG_SERVER for debugging
            $mail->isSMTP();
            $mail->Host       = 'smtp-relay.brevo.com';
            $mail->SMTPAuth   = true;
            $mail->Username = 'hssanghorbel00@gmail.com';          // SMTP username
            $mail->Password = 'hHGWM135XKvnysQt';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS
            $mail->Port       = 587;
            $mail->setFrom('admin@gym.tn', 'Reset Password');
            $mail->addAddress($emailTo);
            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Email';
            $mail->Body    = 'This is a email to Reset your Password. <br> your code is <b> '.$verificationCode.'</b>';
           
            $mail->send();


        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
