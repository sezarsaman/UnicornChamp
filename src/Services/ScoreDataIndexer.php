<?php

namespace PHPBoilerplate\Services;

use League\Csv\Exception;
use League\Csv\TabularDataReader;
use PHPBoilerplate\Contracts\ScoreDataIndexerInterface;
use League\Csv\Reader;
use League\Csv\Statement;

class ScoreDataIndexer implements ScoreDataIndexerInterface
{
    /*
     |--------------------------------------------------------------------------
     | Variables:
     |--------------------------------------------------------------------------
    */
    /**
     * @var TabularDataReader
     */
    private $records;

    /*
     |--------------------------------------------------------------------------
     | Functions:
     |--------------------------------------------------------------------------
    */

    /**
     * @throws Exception
     */
    public function __construct(string $path = '/application/file.csv')
    {
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);

        $stmt = Statement::create()
            ->offset(0)
            ->limit(100);

        $this->records = $stmt->process($csv);
    }

    /**
     * @inheritDoc
     */
    public function getCountOfUsersWithinScoreRange(int $rangeStart, int $rangeEnd): int
    {
        $count = 0;
        foreach ($this->records as $record) {
            if($record['Score'] >= $rangeStart && $record['Score'] <= $rangeEnd){
                $count++;
            }
        }
        return $count;
    }

    /**
     * @inheritDoc
     */
    public function getCountOfUsersByCondition(
        string $region,
        string $gender,
        bool $hasLegalAge,
        bool $hasPositiveScore
    ): int {
        $count = 0;
        foreach ($this->records as $record) {
            if ($record['Region'] != $region) {
                continue;
            }

            if ($record['Gender'] != $gender) {
                continue;
            }

            if ($hasLegalAge && $record['Age'] < 18){
                continue;
            }

            if (!$hasLegalAge && $record['Age'] >= 18){
                continue;
            }

            if ($hasPositiveScore && $record['Score'] < 0){
                continue;
            }

            if (!$hasPositiveScore && $record['Score'] >= 0){
                continue;
            }
            $count++;
        }
        return $count;
    }
}