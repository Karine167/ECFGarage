<?php

namespace App\Controller\Admin;

use App\Entity\Options;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OptionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Options::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('optionName', 'Option');
    }
    
}
