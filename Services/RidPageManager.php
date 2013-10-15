<?php

namespace Rid\Bundle\PageBundle\Services;

use Rid\Bundle\PageBundle\Entity\PageRepositoryInterface;

class RidPageManager implements RidPageManagerInterface
{
    /** @var \Rid\Bundle\PageBundle\Entity\PageRepositoryInterface */
    protected $repository;
    /** @var \Sonata\SeoBundle\Seo\SeoPage */
    protected $seoPage;

    public function setSeoPage($seoPage)
    {
        $this->seoPage = $seoPage;
    }

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
        $page = $this->getObject($slug);
        return $page ? $page->getBody() : '';
    }

    public function getObject($slug)
    {
        return $this->getRepository()->getOneBySlug($slug);
    }

    public function setupSeo($page)
    {
        if (!is_object($page)){$page=$this->getObject($page);}
        if ($page->getMetaTitle()) {
            $this->seoPage->setTitle($page->getMetaTitle());
        }

        if ($page->getMetaDescription()) {
            $this->seoPage->addMeta('name', 'description', $page->getMetaDescription());
        }

        if ($page->getMetaKeywords()) {
            $this->seoPage->addMeta('name', 'keywords', $page->getMetaKeywords());
        }

        if ($page->getMetaAuthor()){
            $this->seoPage->addMeta('name', 'author', $page->getMetaAuthor());
        }
    }
}
