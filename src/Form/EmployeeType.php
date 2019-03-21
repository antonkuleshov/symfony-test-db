<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('gender')
            ->add('birthDate')
            ->add('hireDate')

            ->add('departments', CollectionType::class, [
                'entry_type' => DeptEmployeeType::class,
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'Department'
            ])
            ->add('departmentsManagers', CollectionType::class, [
                'entry_type' => DeptManagerType::class,
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => "Manager's Department"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
