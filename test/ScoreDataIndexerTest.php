<?php

namespace test;

use League\Csv\Exception;
use PHPBoilerplate\Services\ScoreDataIndexer;
use PHPUnit\Framework\TestCase;

class ScoreDataIndexerTest extends TestCase
{
    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */
    /**
     * @test
     * @throws Exception
     */
    public function getCountOfUsersWithinScoreRangeTest()
    {
        $ScoreDataIndexer = new ScoreDataIndexer(getcwd() . '/file.csv');
        $this->assertEquals(
            3,
            $ScoreDataIndexer->getCountOfUsersWithinScoreRange(20, 50)
        );
    }

    /**
     * @test
     * @throws Exception
     */
    public function getCountOfUsersByConditionTest()
    {
        $ScoreDataIndexer = new ScoreDataIndexer(getcwd() . '/file.csv');
        $this->assertEquals(
            1,
            $ScoreDataIndexer->getCountOfUsersByCondition('CA', 'w', false, false)
        );
    }
}