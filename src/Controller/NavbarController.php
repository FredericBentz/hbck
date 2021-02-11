<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class NavbarController extends AbstractController
{

public function __construct(UserRepository $userRepository)
{

    $this->userRepository = $userRepository; 
    
}

public function navbarAction()
{
 
    $user = $this->userRepository->findAll();

return $this->render('components/navbar.html.twig', ["user" => $user]);

}


}