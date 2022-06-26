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
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CommentType.
 */
class CommentType extends AbstractType
{
    /**
     * Builds the form.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
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
                    'constraints' => [
                        new NotBlank([
                            'message' => 'message.not_blank',
                        ]),
                        new Email([
                            'message' => 'message.this_must_be_an_email',
                        ]),
                    ],
                ]
            )
            ->add(
                'nick',
                TextType::class,
                [
                    'label' => 'label.nick',
                    'required' => true,
                    'attr' => ['max_length' => 64],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'message.not_blank',
                        ]),
                    ],
                ]
            )
            ->add(
                'contents',
                TextType::class,
                [
                    'label' => 'label.contents',
                    'required' => true,
                    'attr' => ['max_length' => 300],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'message.not_blank',
                        ]),
                    ],
                ]
            );
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Comment::class]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return 'comment';
    }
}
