<?php

namespace Rid\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function showAction(Request $request)
    {
        $page = $this->getPage($request);

        /** @var \Sonata\SeoBundle\Seo\SeoPage $seoPage */
        $seoPage = $this->container->get('sonata.seo.page');

        if ($page->getMetaTitle()) {
            $seoPage->setTitle($page->getMetaTitle());
        }

        if ($page->getMetaDescription()) {
            $seoPage->addMeta('name', 'description', $page->getMetaDescription());
        }

        if ($page->getMetaKeywords()) {
            $seoPage->addMeta('name', 'keywords', $page->getMetaKeywords());
        }

        if ($page->getMetaAuthor()){
            $seoPage->addMeta('name', 'author', $page->getMetaAuthor());
        }

        return $this->render($this->getShowTemplate(), array(
            'page' => $page,
            'base_template' => $this->getBaseTemplate()
        ));
    }

    /** @return \Rid\Bundle\PageBundle\Entity\Page */
    public function getPage(Request $request)
    {
        return $this->get('rid.page.repository.page')->getOneBySlug($request->get('slug'));
    }

    public function getPages()
    {
        return $this->get('rid.page.repository.page')->findAll();
    }

    public function getShowTemplate()
    {
        $parameters = $this->container->getParameter('rid_page');

        return $parameters['template']['show'];
    }

    public function getBaseTemplate()
    {
        $parameters = $this->container->getParameter('rid_page');

        return $parameters['template']['layout'];
    }
}
