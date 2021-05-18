<?php

require_once '../dbconn.php';
require_once '../functions.php';

use PHPUnit\Framework\TestCase;

class Functions extends TestCase
{
    public function testMalformedGetGames()
    {
        $this->expectException(TypeError::class);
        getGames(0);
    }

    public function testSuccessDisplayGames() {
        $games = [ [
            'bgg-id'=>'259996'
        ] ];
        $case = displayGames($games);
        $this->assertIsString($case);
        $expected = '<article id="259996"></article>';
        $this->assertEquals($expected, $case);
        $games = [ [
            'bgg-id'=>'259996'
        ], [
        'bgg-id'=>'254496'
        ]
        ];
        $expected = '<article id="259996"></article><article id="254496"></article>';
        $case = displayGames($games);
        $this->assertEquals($expected, $case);
    }
    public function testFailureDisplayGames() {
        $games = [ [] ];
        $case = displayGames($games);
        $this->assertIsString($case);
        $this->assertEquals('', $case);
        $games = [ ];
        $case = displayGames($games);
        $this->assertIsString($case);
        $this->assertEquals('', $case);
    }
    public function testMalformedDisplayGames() {
        $this->expectException(TypeError::class);
        displayGames(0);
    }

    public function testSuccessValidateInputGameArray () {
        $game = ['bgg-id'=>'1'];
        $case = validateInputGameArray($game);
        $this->assertEquals(true, $case);
    }
    public function testFailureValidateInputGameArray () {
        $game = [];
        $case = validateInputGameArray($game);
        $this->assertEquals(false, $case);
        $game = ['bgg-id'=>'thirty'];
        $case = validateInputGameArray($game);
        $this->assertEquals(false, $case);
        $games = ['bgg-id'=>'0'];
        $case = validateInputGameArray($games);
        $this->assertEquals(false, $case);
        $games = ['bgg-id'=>'30t'];
        $case = validateInputGameArray($games);
        $this->assertEquals(false, $case);
        $games = ['bgg-id'=>false];
        $case = validateInputGameArray($games);
        $this->assertEquals(false, $case);
    }
    public function testMalformedValidateInputGameArray() {
        $this->expectException(TypeError::class);
        validateInputGameArray(0);
    }
}

?>