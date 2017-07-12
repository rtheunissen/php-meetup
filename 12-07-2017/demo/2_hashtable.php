<?php

/**
 * A basic bucket structure for a hash table.
 */
class Bucket
{
    public $key;
    public $value;
    public $hash;   // Hash value of the key
    public $next;   // Next bucket in the collision chain

    public function __construct($key, $value, $hash)
    {
        $this->key   = $key;
        $this->value = $value;
        $this->hash  = $hash;
        $this->next  = null;
    }
}

/**
 * A basic hash table.
 */
class HashTable
{
    public $capacity;   // The size of the buffer
    public $buffer;     // The buffer of buckets

    /**
     * Creates a new hash table instance and allocates the buffer.
     */
    public function __construct(int $capacity)
    {
        $this->capacity = $capacity;
        $this->buffer   = array_fill(0, $capacity, null);
    }

    /**
     * Our hash function!
     */
    private function hash($key): int
    {
        return strlen($key);
    }

    /**
     * Associates a key with a value.
     */
    public function set($key, $value)
    {
        // Hash the key to get an integer representation of it.
        $hash = $this->hash($key);

        // Determine where in the buffer we want to add this bucket.
        $index = $hash % $this->capacity;

        // Create a new bucket.
        $bucket = new Bucket($key, $value, $hash);

        // Look up the bucket currently in this position (if any).
        $current = $this->buffer[$index] ?? null;

        // If there is not a bucket there already, add the new one.
        if (is_null($current)) {
            $this->buffer[$index] = $bucket;
            return;
        }

        // Otherwise, run down the collision chain.
        for (;;) {

            // If we're at the end of the chain, append the new bucket to it.
            if (is_null($current->next)) {
                $current->next = $bucket;
                return;
            }

            // If the current bucket we're looking at is exactly equal
            // to the new one, all we need to do is replace the value.
            if ($current->key === $bucket->key) {
                $current->value = $value;
                return;
            }

            // Look at the next bucket in the chain...
            $current = $current->next;
        }
    }

    /**
     * Returns the value associated with a given key.
     */
    public function get($key)
    {
        // Hash the key to get an integer representation of it.
        $hash = $this->hash($key);

        // Determine where in the buffer we want to start looking.
        $index = $hash % $this->capacity;

        // Look up the bucket at the start of the chain (if any).
        $bucket = $this->buffer[$index] ?? null;

        // Run down the chain looking for a bucket with the same key.
        for (; $bucket; $bucket = $bucket->next) {
            if ($bucket->key === $key) {
                return $bucket->value;
            }
        }

        // Didn't return in the loop, which means we couldn't find the key.
        throw new Exception('Key not found');
    }

    /** Prints the table. */
    public function print()
    {
        echo "HashTable({$this->capacity}) {\n";

        for ($i = 0; $i < $this->capacity; $i++) {
            echo "    {$i} => ";

            $bucket = $this->buffer[$i] ?? null;

            if ($bucket) {
                $links = [];
                for (; $bucket; $bucket = $bucket->next) {
                    $links[] = "[{$bucket->key} : {$bucket->value}]";
                }
                echo implode(' -> ', $links);
            } else {
                echo "(empty)";
            }

            echo "\n";
        }

        echo "}\n";
    }
}

// Create a new hash table and print it's empty state.
$table = new HashTable(4);
$table->print();

// Add some definitions
$table->set('one',         1); // hash = 3
$table->set('two',         2); // hash = 3
$table->set('three',       3); // hash = 5
$table->set('ten',        10); // hash = 3
$table->set('hundred',   100); // hash = 7
$table->set('thousand', 1000); // hash = 8

$table->print();