<?php

namespace Rid\Bundle\PageBundle\Entity;

interface PageRepositoryInterface
{
    public function getOneBySlug($slug);
}
