<?php

namespace Rid\Bundle\PageBundle\Twig;

use Rid\Bundle\PageBundle\Services\RidPageManagerInterface;

class RidPageExtension extends \Twig_Extension
{
    /** @var \Rid\Bundle\PageBundle\Services\RidPageManagerInterface */
    protected $manager;

    public function setManager(RidPageManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getFunctions()
    {
        return array(
            'rid_page_partial' => new \Twig_SimpleFunction('rid_page_partial', array( $this, 'getPartial') ),
            'rid_page_get_object' => new \Twig_SimpleFunction('rid_page_get_object', array( $this, 'getObject') ),
            'rid_page_setup_seo' => new \Twig_SimpleFunction('rid_page_setup_seo', array( $this, 'getSetupSeo') ),
        );
    }


    public function getPartial($slug)
    {
        return $this->manager->getPartial($slug);
    }

    public function getObject($slug)
    {
        return $this->manager->getObject($slug);
    }

    public function getSetupSeo($page)
    {
        return $this->manager->setupSeo($page);
    }

    public function getName()
    {
        return 'rid_page_extension';
    }
}
