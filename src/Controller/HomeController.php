<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
 
public function __construct()
{
  
}

public function homeAction()
{
    return $this->render('home.html.twig');
}


public function clubAction()
{
    return $this->render('pages/club.html.twig');
}

}

