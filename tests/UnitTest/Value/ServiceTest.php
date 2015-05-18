<?php
namespace SiteConfig\UnitTest\Scope;

use SiteConfig\Value\Service;
use SiteConfig\Value\Value;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Service
     */
    private $service;

    private $repositoryMock;

    protected function setUp()
    {
        $this->repositoryMock = $this->getMockBuilder('SiteConfig\Value\DbRepository')
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new Service($this->repositoryMock);
    }

    public function testCreate()
    {
        $value = new Value('name', 'value');

        $this->repositoryMock->expects($this->once())
            ->method('add')
            ->with($value)
            ->will($this->returnValue(true));

        $result = $this->service->create($value);

        $this->assertTrue($result);
    }

}