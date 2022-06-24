<?php
/**
 * Post type.
 */

namespace App\Form\Type;

use App\Entity\Post;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PostType.
 */
class PostType extends AbstractType
{
    /**
     * Builds form.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                'label' => 'label.title',
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
                    'attr' => ['max_length' => 65535],
                    ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'class' => Category::class,
                    'choice_label' => function ($category): string {
                        return $category->getTitle();
                    },
                    'label' => 'label.category',
                    'placeholder' => 'label.none',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => false,
                ]
            );
    }

    /**
     * Configures the options for this type.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Post::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     */
    public function getBlockPrefix(): string
    {
        return 'post';
    }
}
