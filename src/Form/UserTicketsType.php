<?php

namespace App\Form;

use App\Entity\UserTickets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use App\Repository\CarsRepository;

class UserTicketsType extends AbstractType
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
            ->add('description')
            ->add('date_started')
            ->add('FK_user_ticket_car_id', null, [
                'label' => "Car",
                'choices' => $this->carsRepository->findByUserId($user->getId()),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserTickets::class,
        ]);
    }
}
