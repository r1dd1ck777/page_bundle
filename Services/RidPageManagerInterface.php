<?php

namespace Rid\Bundle\PageBundle\Services;

use Rid\Bundle\PageBundle\Entity\PageRepositoryInterface;

interface RidPageManagerInterface
{
    public function setRepository(PageRepositoryInterface $repository);
    public function getRepository();
    public function getPartial($slug);
    public function getObject($slug);
    public function setupSeo($page);
}
