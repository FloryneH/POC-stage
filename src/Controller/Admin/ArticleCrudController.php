<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('titre');
        yield SlugField::new('slug')->setTargetFieldName('titre');
        yield TextEditorField::new('content');
        yield TextField::new('featuredText');
        yield AssociationField::new('featuredImage');
        yield AssociationField::new('id_category');
        yield DateTimeField::new('createdAt')->hideOnForm();
        yield DateTimeField::new('updatedAt')->hideOnForm();
    }
    
}
