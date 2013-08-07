<?php

namespace Rid\Bundle\PageBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PageAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formBuilder = $formMapper->getFormBuilder();
        $formMapper
        ->with('rid_page.general')
            ->add('isPublished', null, array('data' => true))
            ->add('isOnHomepage', null, array('data' => true))
            ->add('isPartial', null, array('data' => false))
            ->add('slug')
            ->add('title')
            ->add('descriptionF', 'sonata_formatter_type', array(
                'event_dispatcher' => $formBuilder->getEventDispatcher(),
                'format_field'   => 'descriptionFormatter',
                'source_field'   => 'description',
                'source_field_options'      => array(
                    'attr' => array('class' => 'span10', 'rows' => 20)
                ),
                'target_field'   => 'description',
                'listener'       => true,
            ))

            ->add('bodyF', 'sonata_formatter_type', array(
                'event_dispatcher' => $formBuilder->getEventDispatcher(),
                'format_field'   => 'bodyFormatter',
                'source_field'   => 'body',
                'source_field_options'      => array(
                    'attr' => array('class' => 'span10', 'rows' => 20)
                ),
                'target_field'   => 'body',
                'listener'       => true,
            ))
        ->end()
        ->with('rid_page.metaData')
            ->add('metaTitle')
            ->add('metaDescription')
            ->add('metaKeywords')
            ->add('metaAuthor')
        ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('isPublished')
            ->add('slug')
            ->add('title')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', 'text', array('label' => 'Title'))
            ->add('isPublished')
            ->add('isOnHomepage')
            ->add('isPartial')
            ->add('slug')
            ->add('description', null, array('template'=>'RidPageBundle:Admin:page.list_field.description.html.twig'))
            ->add('body', null, array('template'=>'RidPageBundle:Admin:page.list_field.body.html.twig'))
            ->add('_action', 'actions', array(
                'label' => ' ',
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('body')
        ;
    }

    protected function configureRoutes(RouteCollection $collection)
    {
//        $collection->remove('show');
    }

    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'RidPageBundle:Admin:page.edit.html.twig';
                break;
            case 'show':
                return 'RidPageBundle:Admin:page.show.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}
