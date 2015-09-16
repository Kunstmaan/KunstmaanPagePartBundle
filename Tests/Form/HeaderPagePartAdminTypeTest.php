<?php
namespace Kunstmaan\PagePartBundle\Tests\Form;

use Kunstmaan\PagePartBundle\Form\HeaderPagePartAdminType;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-08-20 at 13:19:22.
 */
class HeaderPagePartAdminTypeTest extends PagePartAdminTypeTestCase
{
    /**
     * @var HeaderPagePartAdminType
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new HeaderPagePartAdminType();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * Generated from @assert () == 'kunstmaan_pagepartbundle_headerpageparttype'.
     *
     * @covers Kunstmaan\PagePartBundle\Form\HeaderPagePartAdminType::getName
     */
    public function testGetName()
    {
        $this->assertEquals('kunstmaan_pagepartbundle_headerpageparttype', $this->object->getName());
    }

    /**
     * @covers Kunstmaan\PagePartBundle\Form\HeaderPagePartAdminType::buildForm
     */
    public function testBuildForm()
    {
        $this->object->buildForm($this->builder, array());
        $this->builder->get('niv');
        $this->builder->get('title');
    }

    /**
     * @covers Kunstmaan\PagePartBundle\Form\HeaderPagePartAdminType::configureOptions
     */
    public function testConfigureOptions()
    {
        $this->object->configureOptions($this->resolver);
        $resolve = $this->resolver->resolve();
        $this->assertEquals($resolve["data_class"], 'Kunstmaan\PagePartBundle\Entity\HeaderPagePart');
    }
}
