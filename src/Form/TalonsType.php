<?php

namespace App\Form;

use App\Entity\Talons;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use App\Repository\CarsRepository;

class TalonsType extends AbstractType
{
    private $security;
    private $carsRepository;

    public function __construct(Security $security, CarsRepository $carsRepository)
    {
        $this->security = $security;
        $this->carsRepository = $carsRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();
        $builder
            ->add('registration_plate')
            ->add('vin', null, ['label' => 'VIN'])
            ->add('cc', null, ['label' => 'CC'])
            ->add('registartion_year')
            ->add('expiration_date')
            ->add('FK_talon_car_id', null, [
                'label' => "Car",
                'choices' => $this->carsRepository->findByUserId($user->getId()),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Talons::class,
        ]);
    }
}
