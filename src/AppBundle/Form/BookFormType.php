<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class BookFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'titre'
            ])
            ->add('year', DateType::class, [
                'label' => 'année de parution',
                'format' => 'dd MM y',
                'years' => range(2019,1800, 1)
            ])
            ->add('synopsis', TextType::class)
            ->add('dateBook', DateType::class, [
                'widget' => 'single_text',
                'label' => 'date d\'enregistrement du livre'
            ])
            ->add('cover', FileType::class, [
                'label' => 'photo de couverture'
            ])
//            ->add('author', TextType::class, [
//                'label' => 'Auteur'
//            ])
            ->add('type', TextType::class, [
                'label' => 'categorie'
            ])
            ->add('submit', SubmitType::class, [
            'label' => 'Envoyer'
            ])
            ->add('author', CollectionType::class, array(
                'by_reference' => AuthorType::class,
                    'label' => 'Auteur :',
                )

            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Book'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_book';
    }


}
