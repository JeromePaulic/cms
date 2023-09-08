<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    /* Supprimer le bouton ajouter un commentaire dans l'administration */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    /* Les 3 propriétés du formulaire ajouter un commentaire */
    public function configureFields(string $pageName): iterable
    {
            yield TextareaField::new('content');
            yield DateTimeField::new('createdAt');
            yield AssociationField::new('user');
    }

}
