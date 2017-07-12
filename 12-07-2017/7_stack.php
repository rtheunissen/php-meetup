<?php

// Create a new, empty stack.
$stack = new Ds\Stack();

// Push three values.
$stack->push('a');
$stack->push('b');
$stack->push('c');

// Iterate through the stack, removing the value at the top as we go.
foreach ($stack as $value) {
    var_dump($value, count($stack));
}

// This code is effectively the same thing.
while (! $stack->isEmpty()) {
    var_dump($stack->pop(), count($stack));
}