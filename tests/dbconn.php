<?php

require_once '../dbconn.php';

use PHPUnit\Framework\TestCase;

class Dbconn extends TestCase
{
    public function testSuccessGetDB ()
    {
        $case = getDB('127.0.0.1');
        $this->assertIsObject($case);
        $this->assertInstanceOf(PDO::class, $case);
    }
    public function testFailureGetDB ()
    {
        $this->expectException(PDOException::class);
        getDB('45');
    }
    public function testMalformedGetDB ()
    {
        $this->expectException(TypeError::class);
        getDB([0]);
    }
}

?>