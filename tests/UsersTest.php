<?php

include_once __DIR__ . '\..\objects\user.php';
include_once __DIR__ . '\..\config\database.php';
use PHPUnit\Framework\TestCase;

class UsersTest extends TestCase
{
    private User $object;

    /**
     * @var MockObject|PDO
    */

    protected function setUp(): void
    {
        $this->db = new Database();
        $this->object = new User($this->db->getConnection());
    }

    public function testCreate(): void
    {
        $result = $this->object->create();
        $this->assertTrue($result);
    }

    public function testRead(): void
    {
        $this->object->create();
        $result = $this->object->read();
        $this->assertTrue($result->rowCount() > 0);
    }

    public function testFindUser(): void
    {
        $this->object->create();
        $result = $this->object->findUser();
        $this->assertTrue($result->rowCount() > 0);
    }
}
