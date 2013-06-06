<?php
namespace Users\Development\KunstmaanPagePartBundle\Tests\Twig\Extension;

use Kunstmaan\PagePartBundle\Twig\Extension\PagePartTwigExtension;

class PagePartTwigExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PagePartTwigExtension
     */
    protected $pagePartTwigExtension;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $emMock;

    /**
     * Creates a PagePartTwigExtension for the dev environment
     */
    protected function setUp()
    {
        parent::setUp();
        $this->emMock = $this->getEmMock();
    }

    public function testDevitizeUrl()
    {
        $pagePartTwigExtension = new PagePartTwigExtension($this->emMock, 'dev');
        $pagePartTwigExtension->setDevitizeIndex('app_devv.php');
        $pagePartTwigExtension->setDevitizeIndexEnabled(true);

        $this->assertEquals(
            '/app_devv.php/test/case',
            $pagePartTwigExtension->devitizeUrl('/test/case'));
    }

    public function testDevitizeUrlInProd()
    {
        $pagePartTwigExtension = new PagePartTwigExtension($this->emMock, 'prod');

        $this->assertEquals(
                '/test/case',
                $pagePartTwigExtension->devitizeUrl('/test/case'));
    }

    public function testDevitizeUrlFullPath()
    {
        $pagePartTwigExtension = new PagePartTwigExtension($this->emMock, 'dev');
        $pagePartTwigExtension->setDevitizeIndex('app_devv.php');
        $pagePartTwigExtension->setDevitizeIndexEnabled(true);

        $this->assertEquals(
            'http://www.kunstmaan.be/test',
            $pagePartTwigExtension->devitizeUrl('http://www.kunstmaan.be/test'));
    }

    public function testDevitizeDisabled()
    {
        $pagePartTwigExtension = new PagePartTwigExtension($this->emMock, 'dev');
        $pagePartTwigExtension->setDevitizeIndexEnabled(false);

        $this->assertEquals(
            '/a/path/to',
            $pagePartTwigExtension->devitizeUrl('/a/path/to'));
    }

    public function testDevitizeUrlFullPathSpecialCase()
    {
        $pagePartTwigExtension = new PagePartTwigExtension($this->emMock, 'dev');
        $pagePartTwigExtension->setDevitizeIndex('app_dev.php');
        $pagePartTwigExtension->setDevitizeIndexEnabled(true);

        $this->assertEquals(
            'mailto:hello@kunstmaan.be',
            $pagePartTwigExtension->devitizeUrl('mailto:hello@kunstmaan.be'));
    }

    protected function getEmMock()
    {
        $emMock  = $this->getMock('\Doctrine\ORM\EntityManager', array(), array(), '', false);
        return $emMock;
     }
}
