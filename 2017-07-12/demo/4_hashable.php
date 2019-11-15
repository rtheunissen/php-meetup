<?php

use Ds\Hashable;

/**
 * An account is hashable - it can be used as a key in a Map or value in a Set.
 */
class Account implements Hashable
{
    /**
     * @var string The account's name
     */
    private $name;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return A scalar value to use as this object's "hash value".
     */
    public function hash()
    {
        return $this->name;
    }

    /**
     * @return true if another given object is considered an equal key.
     */
    public function equals($other): bool
    {
        return ($other instanceof $this) && ($other->name === $this->name);
    }
}