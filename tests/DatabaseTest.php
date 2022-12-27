<?php

include_once __DIR__ . '\..\config\database.php';
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private Database $object;

    protected function setUp(): void
    {
        $this->object = new Database();
    }

    public function testGetConnection(): void
    {
        $result = $this->object->getConnection();
        $this->assertInstanceOf(PDO::class, $result);
    }
}
