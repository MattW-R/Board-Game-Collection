<?php

require_once '../dbconn.php';
require_once '../functions.php';

use PHPUnit\Framework\TestCase;

class Functions extends TestCase
{
    public function testSuccessGetGames ()
    {
        // ASSUMING getDB() is working & dbconn.php is in parent directory
        $db = getDB('127.0.0.1');
        $case = getGames($db);
        $this->assertIsArray($case);
        if (count($case) > 0)
        {
            $this->assertArrayHasKey('name', $case[0]);
            $this->assertArrayHasKey('description', $case[0]);
            $this->assertArrayHasKey('year-published', $case[0]);
            $this->assertArrayHasKey('player-count-min', $case[0]);
            $this->assertArrayHasKey('player-count-max', $case[0]);
            $this->assertArrayHasKey('play-time-min', $case[0]);
            $this->assertArrayHasKey('play-time-max', $case[0]);
            $this->assertArrayHasKey('rating', $case[0]);
            $this->assertArrayHasKey('complexity', $case[0]);
            $this->assertArrayHasKey('image-url', $case[0]);
        }
    }
    public function testMalformedGetGames ()
    {
        $this->expectException(TypeError::class);
        getGames(0);
    }

    public function testSuccessDisplayGames () {
        $games = [ ['name'=>'name',
            'description'=>'description',
            'year-published'=>'year-published',
            'player-count-min'=>'player-count-min',
            'player-count-max'=>'player-count-max',
            'rating'=>'rating',
            'complexity'=>'complexity',
            'image-url'=>'image-url'] ];
        $case = displayGames($games);
        $this->assertIsString($case);
    }
    public function testFailureDisplayGames () {
        $games = [ [] ];
        $case = displayGames($games);
        $this->assertIsString($case);
        $this->assertEquals('<article><div></div></article>', $case);
        $games = [ ];
        $case = displayGames($games);
        $this->assertIsString($case);
        $this->assertEquals('', $case);
    }
    public function testMalformedDisplayGames ()
    {
        $this->expectException(TypeError::class);
        displayGames(0);
    }
}

?>