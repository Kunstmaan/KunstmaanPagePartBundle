<?php

namespace Kunstmaan\PagePartBundle\Twig\Extension;

use Doctrine\ORM\EntityManager;
use Kunstmaan\PagePartBundle\Repository\PagePartRefRepository;
use Kunstmaan\PagePartBundle\Helper\PagePartInterface;
use Kunstmaan\PagePartBundle\Helper\HasPagePartsInterface;

/**
 * PagePartTwigExtension
 */
class PagePartTwigExtension extends \Twig_Extension
{

    protected $em;

    /**
     * @var \Twig_Environment
     */
    protected $environment;

    /**
     * @var string
     */
    protected $kernelEnvironment;

    /**
     * @var boolean
     */
    protected $devitizeIndexEnabled;

    /**
     * @var string
     */
    protected $devitizeIndex;

    /**
     * @param EntityManager $em
     * @param string        $kernelEnvironment
     */
    public function __construct(EntityManager $em, $kernelEnvironment)
    {
        $this->em = $em;
        $this->kernelEnvironment = $kernelEnvironment;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'devitize_url' => new \Twig_Filter_Method($this, 'devitizeUrl'),
        );
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'render_pageparts'  => new \Twig_Function_Method($this, 'renderPageParts', array('needs_context' => true, 'is_safe' => array('html'))),
            'getpageparts'  => new \Twig_Function_Method($this, 'getPageParts'),
        );
    }

    /**
     * @param array                 $twigContext The twig context
     * @param HasPagePartsInterface $page        The page
     * @param string                $contextName The pagepart context
     * @param array                 $parameters  Some extra parameters
     *
     * @return string
     */
    public function renderPageParts(array $twigContext, HasPagePartsInterface $page, $contextName = "main", array $parameters = array())
    {
        $template = $this->environment->loadTemplate("KunstmaanPagePartBundle:PagePartTwigExtension:widget.html.twig");
        /* @var $entityRepository PagePartRefRepository */
        $entityRepository = $this->em->getRepository('KunstmaanPagePartBundle:PagePartRef');
        $pageparts = $entityRepository->getPageParts($page, $contextName);
        $newTwigContext = array_merge($parameters, array(
            'pageparts' => $pageparts
        ));
        $newTwigContext = array_merge($newTwigContext, $twigContext);

        return $template->render($newTwigContext);
    }

    /**
     * @param HasPagePartsInterface $page    The page
     * @param string                $context The pagepart context
     *
     * @return PagePartInterface[]
     */
    public function getPageParts(HasPagePartsInterface $page, $context = "main")
    {
        /**@var $entityRepository PagePartRefRepository */
        $entityRepository = $this->em->getRepository('KunstmaanPagePartBundle:PagePartRef');
        $pageparts = $entityRepository->getPageParts($page, $context);

        return $pageparts;
    }

    /**
     * @param string $url    The url
     *
     * @return string
     */
    public function devitizeUrl($url)
    {
        if ($this->kernelEnvironment != 'dev' || $this->devitizeIndexEnabled !== true) {
            return $url;
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return sprintf('/%s%s', $this->devitizeIndex, $url);
        }

        return $url;
    }

    public function setDevitizeIndex($devitizeIndex)
    {
        $this->devitizeIndex = $devitizeIndex;
    }

    public function setDevitizeIndexEnabled($devitizeIndexEnabled)
    {
        $this->devitizeIndexEnabled = $devitizeIndexEnabled;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'pageparts_twig_extension';
    }

}
