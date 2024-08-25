<?php

namespace MrAuGir\Paginator\Collection;

interface CollectionInterface extends \Countable, \IteratorAggregate, \ArrayAccess
{
    /**
     * Adds an element at the end of the collection.
     *
     * @param mixed $element
     */
    public function add($element): void;

    /**
     * Clears the collection, removing all elements.
     */
    public function clear(): void;

    /**
     * Checks whether an element is in the collection.
     *
     * @param mixed $element
     * @return bool
     */
    public function contains($element): bool;

    /**
     * Checks whether the collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Removes the specified element from the collection.
     *
     * @param mixed $element
     * @return bool True if this collection contained the specified element, false otherwise.
     */
    public function remove($element): bool;

    /**
     * Removes the element at the specified index.
     *
     * @param int|string $key
     * @return mixed The removed element or null if no element exists for the given key.
     */
    public function removeElement($key);

    /**
     * Checks whether the collection contains an element with the specified key/index.
     *
     * @param int|string $key
     * @return bool
     */
    public function containsKey($key): bool;

    /**
     * Gets the element at the specified key/index.
     *
     * @param int|string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Gets all keys/indices of the collection.
     *
     * @return array
     */
    public function getKeys(): array;

    /**
     * Gets all values of the collection.
     *
     * @return array
     */
    public function getValues(): array;

    /**
     * Sets an element in the collection at the specified key/index.
     *
     * @param int|string $key
     * @param mixed $value
     */
    public function set(int|string $key, $value): void;

    /**
     * Returns the number of elements in the collection.
     *
     * @return int
     */
    public function count(): int;
}
