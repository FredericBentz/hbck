<?php

namespace App\Controller\Admin;

use App\Entity\Suspended;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class SuspendedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suspended::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
            AssociationField::new('user_id', 'User'),
            IntegerField::new('nb_game', 'Nb game'),
            //AssociationField::new('match_id_start', 'Match start'),
            //AssociationField::new('match_id_end', 'Match end'),
            BooleanField::new('is_suspended')
        ];
    }
}
