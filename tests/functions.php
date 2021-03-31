<?php

require_once '../dbconn.php';
require_once '../functions.php';

use PHPUnit\Framework\TestCase;

class Functions extends TestCase
{
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