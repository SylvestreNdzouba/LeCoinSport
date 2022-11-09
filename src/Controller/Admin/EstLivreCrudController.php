<?php

namespace App\Controller\Admin;

use App\Entity\EstLivre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EstLivreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EstLivre::class;
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
