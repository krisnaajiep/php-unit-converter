<?php

require_once 'functions.php';

$units = setUnits();
$errors = [];
$oldData = [];

// Set the default unit to length if the unit is not set or not in the list
$_GET['unit'] = empty($_GET['unit']) || !in_array($_GET['unit'], ['length', 'weight', 'temperature'])
    ? 'length'
    : $_GET['unit'];

require_once 'handle-conversion.php';
