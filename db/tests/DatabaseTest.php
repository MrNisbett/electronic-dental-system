<?php

include_once __DIR__ . '\..\config\database.php';
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private Database $object;

    /**
     * @var MockObject|PDO
    */
    private $connection;

    protected function setUp(): void
    {

        $this->connection = $this->createMock(PDO::class);
        $this->object = new Database();
    }

    public function testGetConnection(): void
    {
        $result = $this->object->getConnection();
        $this->assertInstanceOf(PDO::class, $result);
    }
}
