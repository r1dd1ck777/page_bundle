<?php

namespace Rid\Bundle\PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    public function showAction(Request $request)
    {
        $page = $this->getPage($request);

        if (!$page){
            throw $this->createNotFoundException();
        }

        $pageManager = $this->container->get('rid_page');
        $pageManager->setupSeo($page);

        return $this->render($this->getShowTemplate(), array(
            'page' => $page,
            'base_template' => $this->getBaseTemplate()
        ));
    }

    public function renderPageAction()
    {
        $page = $this->get('rid.page.repository.page')->getOneBySlug($this->getRequest()->get('slug', 'default'));

        return $this->render($this->getRenderTemplate(),
            array('page' => $page)
        );
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

    public function getRenderTemplate()
    {
        $parameters = $this->container->getParameter('rid_page');

        return $parameters['template']['render'];
    }
}
