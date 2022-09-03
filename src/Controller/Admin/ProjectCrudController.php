<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Project')
            ->setEntityLabelInPlural('Project')
            ->setPageTitle('index', '%entity_label_plural%')
            ->setPageTitle('detail', fn (Project $project) => (string) $project)
            ->setPageTitle('edit', fn (Project $project) => sprintf('Editing <b>%s</b>', $project->getTitle()))
            ->setDefaultSort(['title' => 'ASC'])
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')->onlyOnDetail();
        yield TextField::new('title');
        yield AssociationField::new('category', 'Category')->setCrudController(CategoryCrudController::class);
        yield TextEditorField::new('content')->onlyOnForms();
        yield ImageField::new('cover', 'Image')->setUploadDir('public/uploads')->setBasePath('uploads')->setUploadedFileNamePattern('[name]-[timestamp].[extension]');
    }

}
