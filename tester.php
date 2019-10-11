<?php

require_once ('AvailableActions.php');

$task1 = new AvailableActions(1,25,'in progress', 5);

var_dump($task1->getActionList());
var_dump($task1->getNextStatus('take'));
