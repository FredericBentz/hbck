<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TeamController extends AbstractController
{
 
public function __construct()
{
  
}

public function homeAction()
{
    return $this->render('pages/team.html.twig');
}

}