<?php

    namespace App\Form;

    use App\Entity\Category;
    use App\Entity\Wish;
    use Doctrine\ORM\EntityRepository;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class WishType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('title', TextType::class, [
                    'label' => 'Your idea'
                ])
                ->add('description', TextareaType::class, [
                    'required' => false,
                    'label' => 'Please describe it!'
                ])
                ->add('author', TextType::class, [
                    'label' => 'Your username',

                ])
                ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'label' => 'Category',
                    'placeholder' => '--Choose a category--',
                    'query_builder' => function (EntityRepository $entityRepository) {
                        return $entityRepository->createQueryBuilder('c')->orderBy('c.id', 'ASC');
                    }
                ]);
        }

        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Wish::class,
            ]);
        }
    }
