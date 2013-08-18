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
        );
    }


    public function getPartial($slug)
    {
       return $this->manager->getPartial($slug);
    }

    public function getName()
    {
        return 'rid_page_extension';
    }
}
