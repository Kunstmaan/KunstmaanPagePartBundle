<?php

namespace Kunstmaan\PagePartBundle\Controller;

use Kunstmaan\PagePartBundle\Entity\AbstractPagePart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Generic Controller for pageparts
 */
class PagePartAdminController extends Controller
{

    /**
     * Generic Action for a page part
     * 
     * @param AbstractPagePart $pagePart
     * @return type
     */
    public function indexAction(AbstractPagePart $pagePart)
    {
        return $this->render($pagePart->getDefaultView(), array('resource' => $pagePart));
    }

}
