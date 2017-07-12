<?php

include __DIR__ . "/4_hashable.php";

$map = new Ds\Map();

$map->put('a', 1);
$map->put('b', 2);
$map->put('c', 3);

foreach ($map as $key => $value) {
    print_r([
        'key' => $key,
        'val' => $value,
    ]);
}

// $map = new Ds\Map();

// // Use hashable object
// $map[new Account('a')] = 1;
// $map[new Account('b')] = 20;
// $map[new Account('c')] = 300;
// $map[new Account('c')] = 1000;

// // Use standard object, which will use spl_object_hash
// $map[new stdClass()] = 'x';
// $map[new stdClass()] = 'y';

// // Use a new instance of the same hashable key.
// var_dump($map[new Account('a')]);

// // Use a new instance of the same non-hashable key.
// var_dump($map[new stdClass()]);

// $map->clear();

// Keys can be anything, not just strings and integers.
// $map[true] = 'yes';
// var_dump($map->get(true));

// Key types are strict, default is optional.
// $map[1.0] = 'one';
// var_dump($map->get(1));
