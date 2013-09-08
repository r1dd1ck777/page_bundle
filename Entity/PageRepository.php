<?php

namespace Rid\Bundle\PageBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository implements PageRepositoryInterface
{
    public function getOneBySlug($slug)
    {
        $page = $this->findOneBy(array('slug' => $slug));
        if (!$page){
            $page = $this->create();
            $page->setNotFound(true);
            $page->setTitle('not found');
            $page->setBody("Please create page with slug '{$slug}' in admin panel.");
        }

        return $page;
    }

    /** @return \Rid\Bundle\PageBundle\Entity\Page */
    public function create()
    {
        return new $this->_entityName;
    }
}
