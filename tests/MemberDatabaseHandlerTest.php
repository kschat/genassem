<?php

include_once 'app/config/config.php';
include_once 'core/utils/database/MemberDatabaseHandler.class.php';

class MemberDatabaseHandlerTest extends PHPUnit_Framework_TestCase
{
    public $testDBH;

    public function setUp() { 
        $this->testDBH = new MemberDatabaseHandler(DB_NAME, DB_HOST, DB_USER, DB_PASSWORD);
    }

    public function tearDown() { }

    public function testConnection() {
        $this->assertTrue($this->testDBH !== null);
    }

    /**
     * @covers Class::Method
     */
    public function testGetMembers() {
        $id = 0;
        $offset = 0;
        $amount = 1;
        $result = $this->testDBH->getMembers($id, $offset, $amount);

        $this->assertTrue(sizeof($result) === 1);
    }
    
}
