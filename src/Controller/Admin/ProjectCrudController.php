<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'name'),
            TextEditorField::new('introduction', 'Introduction'),
            TextEditorField::new('description', 'Description'),
            ImageField::new('picture', 'Picture')
            ->setBasepath('/assets/img/portfolio/')
            ->setUploadDir('public/assets/img/portfolio/'),
            UrlField::new('Url', 'url'),
        ];
    }
    
}
