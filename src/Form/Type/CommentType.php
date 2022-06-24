<?php
/**
 * Comment type.
 */

namespace App\Form\Type;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class CommentType.
 */
class CommentType extends AbstractType
{
    /**
     * Builds the form.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'email',
                TextType::class,
                [
                'label' => 'label.email',
                'required' => true,
                'attr' => ['max_length' => 64],
                ]
            )
            ->add(
                'nick',
                TextType::class,
                [
                    'label' => 'label.nick',
                    'required' => true,
                    'attr' => ['max_length' => 64],
                ]
            )
            ->add(
                'contents',
                TextType::class,
                [
                    'label' => 'label.contents',
                    'required' => true,
                    'attr' => ['max_length' => 300],
                ]
            );
    }

    /**
     * Configures the options for this type.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Comment::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     */
    public function getBlockPrefix(): string
    {
        return 'comment';
    }
}
