<?php

namespace App\Controller\Admin;

use App\Entity\ModePaiement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ModePaiementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ModePaiement::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
