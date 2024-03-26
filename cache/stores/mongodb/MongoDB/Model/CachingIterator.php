<?php
/*
<<<<<<< HEAD
 * Copyright 2017-present MongoDB, Inc.
=======
 * Copyright 2017 MongoDB, Inc.
>>>>>>> forked/LAE_400_PACKAGE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
<<<<<<< HEAD
 *   https://www.apache.org/licenses/LICENSE-2.0
=======
 *   http://www.apache.org/licenses/LICENSE-2.0
>>>>>>> forked/LAE_400_PACKAGE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace MongoDB\Model;

use Countable;
use Iterator;
use IteratorIterator;
<<<<<<< HEAD
use ReturnTypeWillChange;
use Traversable;

use function count;
use function current;
=======
use Traversable;
use function count;
use function current;
use function key;
>>>>>>> forked/LAE_400_PACKAGE
use function next;
use function reset;

/**
 * Iterator for wrapping a Traversable and caching its results.
 *
 * By caching results, this iterators allows a Traversable to be counted and
 * rewound multiple times, even if the wrapped object does not natively support
 * those operations (e.g. MongoDB\Driver\Cursor).
 *
 * @internal
 */
class CachingIterator implements Countable, Iterator
{
<<<<<<< HEAD
    private const FIELD_KEY = 0;
    private const FIELD_VALUE = 1;

    /** @var array */
    private $items = [];

    /** @var Iterator */
=======
    /** @var array */
    private $items = [];

    /** @var IteratorIterator */
>>>>>>> forked/LAE_400_PACKAGE
    private $iterator;

    /** @var boolean */
    private $iteratorAdvanced = false;

    /** @var boolean */
    private $iteratorExhausted = false;

    /**
     * Initialize the iterator and stores the first item in the cache. This
     * effectively rewinds the Traversable and the wrapping IteratorIterator.
<<<<<<< HEAD
     * Additionally, this mimics behavior of the SPL iterators and allows users
     * to omit an explicit call to rewind() before using the other methods.
=======
     *  Additionally, this mimics behavior of the SPL iterators and allows users
     * to omit an explicit call * to rewind() before using the other methods.
>>>>>>> forked/LAE_400_PACKAGE
     *
     * @param Traversable $traversable
     */
    public function __construct(Traversable $traversable)
    {
<<<<<<< HEAD
        $this->iterator = $traversable instanceof Iterator ? $traversable : new IteratorIterator($traversable);
=======
        $this->iterator = new IteratorIterator($traversable);
>>>>>>> forked/LAE_400_PACKAGE

        $this->iterator->rewind();
        $this->storeCurrentItem();
    }

    /**
<<<<<<< HEAD
     * @see https://php.net/countable.count
     */
    public function count(): int
=======
     * @see http://php.net/countable.count
     * @return integer
     */
    public function count()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->exhaustIterator();

        return count($this->items);
    }

    /**
<<<<<<< HEAD
     * @see https://php.net/iterator.current
     * @return mixed
     */
    #[ReturnTypeWillChange]
    public function current()
    {
        $currentItem = current($this->items);

        return $currentItem !== false ? $currentItem[self::FIELD_VALUE] : false;
    }

    /**
     * @see https://php.net/iterator.key
     * @return mixed
     */
    #[ReturnTypeWillChange]
    public function key()
    {
        $currentItem = current($this->items);

        return $currentItem !== false ? $currentItem[self::FIELD_KEY] : null;
    }

    /**
     * @see https://php.net/iterator.next
     */
    public function next(): void
=======
     * @see http://php.net/iterator.current
     * @return mixed
     */
    public function current()
    {
        return current($this->items);
    }

    /**
     * @see http://php.net/iterator.key
     * @return mixed
     */
    public function key()
    {
        return key($this->items);
    }

    /**
     * @see http://php.net/iterator.next
     * @return void
     */
    public function next()
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! $this->iteratorExhausted) {
            $this->iteratorAdvanced = true;
            $this->iterator->next();

            $this->storeCurrentItem();

            $this->iteratorExhausted = ! $this->iterator->valid();
        }

        next($this->items);
    }

    /**
<<<<<<< HEAD
     * @see https://php.net/iterator.rewind
     */
    public function rewind(): void
=======
     * @see http://php.net/iterator.rewind
     * @return void
     */
    public function rewind()
>>>>>>> forked/LAE_400_PACKAGE
    {
        /* If the iterator has advanced, exhaust it now so that future iteration
         * can rely on the cache.
         */
        if ($this->iteratorAdvanced) {
            $this->exhaustIterator();
        }

        reset($this->items);
    }

    /**
<<<<<<< HEAD
     * @see https://php.net/iterator.valid
     */
    public function valid(): bool
=======
     * @see http://php.net/iterator.valid
     * @return boolean
     */
    public function valid()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->key() !== null;
    }

    /**
     * Ensures that the inner iterator is fully consumed and cached.
     */
<<<<<<< HEAD
    private function exhaustIterator(): void
=======
    private function exhaustIterator()
>>>>>>> forked/LAE_400_PACKAGE
    {
        while (! $this->iteratorExhausted) {
            $this->next();
        }
    }

    /**
     * Stores the current item in the cache.
     */
<<<<<<< HEAD
    private function storeCurrentItem(): void
    {
        if (! $this->iterator->valid()) {
            return;
        }

        // Storing a new item in the internal cache
        $this->items[] = [
            self::FIELD_KEY => $this->iterator->key(),
            self::FIELD_VALUE => $this->iterator->current(),
        ];
=======
    private function storeCurrentItem()
    {
        $key = $this->iterator->key();

        if ($key === null) {
            return;
        }

        $this->items[$key] = $this->iterator->current();
>>>>>>> forked/LAE_400_PACKAGE
    }
}
