<?php

namespace App\Controller\Admin;

use App\Entity\Season;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SeasonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Season::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           TextField::new('label'),
           DateField::new('start_season', 'Season start'),
           DateField::new('end_season', 'Season end'),
          // AssociationField::new('matchHandball_id', 'Match')
        ];
    }
}
