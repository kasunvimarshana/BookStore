<?php
    namespace App\Form;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use AppBundle\Entity\Category;
    
    class CategoryForm extends AbstractType{
        public function buildForm(FormBuilderInterface $builder, array $options){
            $builder
                ->add('name', 
                    TextType::class,
                    [
                        'attr' => [
                            'class' => 'input'
                        ]
                    ])
                ->add('save', SubmitType::class)
            ;
        }
    }
?>