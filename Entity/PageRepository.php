<?php

namespace Rid\Bundle\PageBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository
{
    public function getOneBySlug($slug)
    {
        return $this->findOneBy(array('slug' => $slug));
    }
}
