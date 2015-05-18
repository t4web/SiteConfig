<?php
namespace SiteConfig\UnitTest\Scope;

use SiteConfig\Value\DbRepository;
use SiteConfig\Value\Value;

class DbRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var DbRepository
     */
    private $repository;

    private $tableGatewayMock;
    private $mapperMock;

    protected function setUp()
    {
        $this->tableGatewayMock = $this->getMockBuilder('Zend\Db\TableGateway\TableGatewayInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapperMock = $this->getMockBuilder('SiteConfig\Value\Mapper')
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new DbRepository(
            $this->tableGatewayMock,
            $this->mapperMock
        );
    }

    public function testCreate()
    {
        $value = new Value('name', 'value');
        $row = [
            'name' => $value->getName(),
            'value' => $value->getValue()
        ];

        $this->mapperMock->expects($this->once())
            ->method('toTableRow')
            ->with($value)
            ->will($this->returnValue($row));

        $this->tableGatewayMock->expects($this->once())
            ->method('insert')
            ->with($row)
            ->will($this->returnValue(true));

        $result = $this->repository->add($value);

        $this->assertTrue($result);
    }

}