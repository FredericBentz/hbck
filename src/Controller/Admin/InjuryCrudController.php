<?php

namespace App\Controller\Admin;

use App\Entity\Injury;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class InjuryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Injury::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user_id', 'User'),
            DateField::new('start'),
            DateField::new('date_end'),
            BooleanField::new('is_injured')    
        ];
    }
   
}
