<?php
require_once '../vendor/autoload.php';

use PHPBoilerplate\Services\ScoreDataIndexer;

$index = new ScoreDataIndexer();
echo '<h1>#1</h1>';
echo $index->getCountOfUsersWithinScoreRange(20, 50); // 3
echo '<br>';
echo $index->getCountOfUsersWithinScoreRange(-40, 0); // 1
echo '<br>';
echo $index->getCountOfUsersWithinScoreRange(0, 80); // 4
echo '<br>';
echo $index->getCountOfUsersByCondition('CA', 'w', false, false); // 1
echo '<br>';
echo $index->getCountOfUsersByCondition('CA', 'w', false, true); // 0
echo '<br>';
echo $index->getCountOfUsersByCondition('CA', 'w', true, true); // 1

echo '<h1>#2</h1>';
echo '<code>SELECT <br>&nbsp;&nbsp;&nbsp;&nbsp;b.country,<br>&nbsp;&nbsp;&nbsp;&nbsp;b.state,<br>&nbsp;&nbsp;&nbsp;&nbsp;(SELECT avg(l.value) FROM loan as l where l.is_active = 1 and l.branch_id = b.id) AS average<br>&nbsp;&nbsp;FROM branch as b</code>';