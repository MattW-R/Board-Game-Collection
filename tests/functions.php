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
        $games = ['name'=>'Exploding Kittens',
            'bgg-id'=>'1',
            'description'=>'desc',
            'year-published'=>'2015',
            'player-count-min'=>'2',
            'player-count-max'=>'5',
            'play-time-min'=>'15',
            'play-time-max'=>'15',
            'rating'=>'6.0',
            'complexity'=>'1.07',
            'image-url'=>'https://cf.geekdo-images.com/N8bL53-pRU7zaXDTrEaYrw__original/img/0ciN1VZYifUd0qIDO0e8cGXmiss=/0x0/filters:format(png)/pic2691976.png'];
        $case = validateInputGameArray($games);
        $this->assertEquals(true, $case);
        $games = ['name'=>'Exploding Kittens',
            'bgg-id'=>'1',
            'description'=>'desc',
            'year-published'=>'2015',
            'player-count-min'=>'2',
            'player-count-max'=>'2',
            'play-time-min'=>'15',
            'play-time-max'=>'45',
            'rating'=>'6.0',
            'complexity'=>'1.07',
            'image-url'=>'https://cf.geekdo-images.com/N8bL53-pRU7zaXDTrEaYrw__original/img/0ciN1VZYifUd0qIDO0e8cGXmiss=/0x0/filters:format(png)/pic2691976.png'];
        $case = validateInputGameArray($games);
        $this->assertEquals(true, $case);
    }
    public function testFailureValidateInputGameArray () {
        $games = ['name'=>'Exploding Kittens',
            'bgg-id'=>'1',
            'description'=>'desc',
            'play-time-min'=>'15',
            'play-time-max'=>'15',
            'rating'=>'6.0',
            'complexity'=>'1.07',
            'image-url'=>'https://cf.geekdo-images.com/N8bL53-pRU7zaXDTrEaYrw__original/img/0ciN1VZYifUd0qIDO0e8cGXmiss=/0x0/filters:format(png)/pic2691976.png'];
        $case = validateInputGameArray($games);
        $this->assertEquals(false, $case);
        $games = ['name'=>'Exploding Kittens',
                'bgg-id'=>'thirty',
            'description'=>'desc',
            'year-published'=>'2011',
            'player-count-min'=>'2',
            'player-count-max'=>'2',
            'play-time-min'=>'15',
            'play-time-max'=>'45',
            'rating'=>'6.0',
            'complexity'=>'1.07',
            'image-url'=>'https://cf.geekdo-images.com/N8bL53-pRU7zaXDTrEaYrw__original/img/0ciN1VZYifUd0qIDO0e8cGXmiss=/0x0/filters:format(png)/pic2691976.png'];
        $case = validateInputGameArray($games);
        $this->assertEquals(false, $case);
        $games = ['name'=>'Exploding Kittens',
            'bgg-id'=>'1',
            'description'=>'desc',
            'year-published'=>'2015',
            'player-count-min'=>'2',
            'player-count-max'=>'2',
            'play-time-min'=>'15',
            'play-time-max'=>'45',
                'rating'=>'11',
            'complexity'=>'1.07',
            'image-url'=>'https://cf.geekdo-images.com/N8bL53-pRU7zaXDTrEaYrw__original/img/0ciN1VZYifUd0qIDO0e8cGXmiss=/0x0/filters:format(png)/pic2691976.png'];
        $case = validateInputGameArray($games);
        $this->assertEquals(false, $case);
        $games = ['name'=>'Exploding Kittens',
            'bgg-id'=>'1',
            'description'=>'desc',
            'year-published'=>'2015',
            'player-count-min'=>'2',
            'player-count-max'=>'2',
            'play-time-min'=>'15',
            'play-time-max'=>'45',
            'rating'=>'11',
                'complexity'=>'-2',
            'image-url'=>'https://cf.geekdo-images.com/N8bL53-pRU7zaXDTrEaYrw__original/img/0ciN1VZYifUd0qIDO0e8cGXmiss=/0x0/filters:format(png)/pic2691976.png'];
        $case = validateInputGameArray($games);
        $this->assertEquals(false, $case);
    }
    public function testMalformedValidateInputGameArray() {
        $this->expectException(TypeError::class);
        validateInputGameArray(0);
    }
}

?>