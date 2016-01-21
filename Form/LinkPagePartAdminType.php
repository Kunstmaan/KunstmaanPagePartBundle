<?php

namespace Kunstmaan\PagePartBundle\Form;
use Kunstmaan\NodeBundle\Form\Type\URLChooserType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

/**
 * LinkPagePartAdminType
 */
class LinkPagePartAdminType extends AbstractType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array                                        $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url', URLChooserType::class, array('label' => 'pagepart.link.choose', 'required' => false))
            ->add('openinnewwindow', CheckboxType::class, array('label' => 'pagepart.link.openinnewwindow', 'required' => false))
            ->add('text', null, array('label' => 'pagepart.link.text', 'required' => false));
    }

    /**
     * @assert () == 'kunstmaan_pagepartbundle_linkpageparttype'
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'kunstmaan_pagepartbundle_linkpageparttype';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kunstmaan\PagePartBundle\Entity\LinkPagePart',
        ));
    }
}
