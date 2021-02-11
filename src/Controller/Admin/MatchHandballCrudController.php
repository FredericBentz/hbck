<?php

namespace App\Controller\Admin;

use App\Entity\MatchHandball;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class MatchHandballCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MatchHandball::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            DateTimeField::new('datetime'),
            IntegerField::new('score_home'),
            IntegerField::new('score_away'),
            AssociationField::new('league_id', 'League'),
            AssociationField::new('season_id', 'Season'),
            AssociationField::new('team_home_id', 'Team home'),
            AssociationField::new('team_away_id', 'Team away')
        ];
    }
    
}
