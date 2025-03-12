<?php

require_once 'functions.php';

session_start();

// Generate a CSRF token
if (!isset($_SESSION['csrf_token']))
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// Set the units based on the selected category
$units = setUnits();

// Initialize variables
$result = '';
$errors = [];
$oldData = [];

// Set the default unit to length if the unit is not set or not in the list
$_GET['unit'] =
    empty($_GET['unit']) ||
    !in_array($_GET['unit'], ['length', 'weight', 'temperature'])
    ? 'length'
    : $_GET['unit'];

require_once 'handle-conversion.php';
