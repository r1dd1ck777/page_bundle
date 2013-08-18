<?php

namespace Rid\Bundle\PageBundle\Services;

use Rid\Bundle\PageBundle\Entity\PageRepositoryInterface;

class RidPageManager implements RidPageManagerInterface
{
    /** @var \Rid\Bundle\PageBundle\Entity\PageRepositoryInterface */
    protected $repository;

    public function setRepository(PageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /** @return \Rid\Bundle\PageBundle\Entity\PageRepositoryInterface */
    public function getRepository()
    {
        return $this->repository;
    }

    public function getPartial($slug)
    {
        $page = $this->getRepository()->getOneBySlug($slug);
        return $page ? $page->getBody() : '';
    }
}
