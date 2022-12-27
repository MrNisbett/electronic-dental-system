<?php

include_once __DIR__ . '\..\objects\ticket.php';
include_once __DIR__ . '\..\config\database.php';
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{
    private Ticket $object;

    /**
     * @var MockObject|PDO
    */

    protected function setUp(): void
    {
        $this->db = new Database();
        $this->object = new Ticket($this->db->getConnection());
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

    public function testUserTickers(): void
    {
        $this->object->create();
        $result = $this->object->userTickets();
        $this->assertTrue($result->rowCount() > 0);
    }

}
