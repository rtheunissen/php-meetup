<?php

$map = new SplObjectStorage();

$map->attach(new stdClass(), 1);
$map->attach(new stdClass(), 2);
$map->attach(new stdClass(), 3);

// The keys are actually the values...
foreach ($map as $key => $value) {
    print_r([
        'key' => $key,
        'val' => $value
    ]);
}

// Can't do this.
$map->attach('a', 1);