<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Admin\Trait\UserTrait;
use App\Form\RoleType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    use UserTrait; 

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            TelephoneField::new('Tel')
                ->hideOnIndex(), 
            EmailField::new('email')
                ->hideOnIndex(),
            TextField::new('password')
                ->onlyOnForms(),
            ChoiceField::new('roles')
                ->setChoices(['ROLE_USER' => 'ROLE_USER', 'ROLE_APPRENTI' => 'ROLE_APPRENTI', 'ROLE_SENIOR' => 'ROLE_SENIOR', 'ROLE_ADMIN' => 'ROLE_ADMIN' ])
                ->setFormType(RoleType::class)
                ->allowMultipleChoices(false),
            ImageField::new('avatar')
                ->setUploadDir('public/assets/images')
                ->setBasePath('assets/images'),
            DateTimeField::new('createdAt')
                ->onlyOnDetail(),
            TextField::new('address')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur');
    }

    // public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters):QueryBuilder

    // {
    // return $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);

    // }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        
    }


}