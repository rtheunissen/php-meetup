<?php

include __DIR__ . "/4_hashable.php";

use Ds\Set;

$set = new Ds\Set();

// Use hashable object
$set[] = new Account('a');
$set[] = new Account('b');
$set[] = new Account('c');
$set[] = new Account('c');

// Use standard object
$set[] = new stdClass();
$set[] = new stdClass();

// Use a new instance of the same hashable key
var_dump($set->contains(new Account('a')));

// Use a new instance of the same non-hashable key
var_dump($set->contains(new stdClass()));
