<?php

namespace App\Controller\Admin;

use App\Entity\Acheteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class AcheteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Acheteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Nom'),
            TextField::new('Prenom'),
            NumberField::new('Tel'),
            TextField::new('Email'),
            /*IdField::new('id_ville'),*/

            
        ];
    }
    
}
