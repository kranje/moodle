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

use Closure;
use Iterator;
use IteratorIterator;
<<<<<<< HEAD
use ReturnTypeWillChange;
=======
>>>>>>> forked/LAE_400_PACKAGE
use Traversable;

/**
 * Iterator to apply a callback before returning an element
 *
 * @internal
 */
class CallbackIterator implements Iterator
{
    /** @var Closure */
    private $callback;

<<<<<<< HEAD
    /** @var Iterator */
=======
    /** @var IteratorIterator */
>>>>>>> forked/LAE_400_PACKAGE
    private $iterator;

    public function __construct(Traversable $traversable, Closure $callback)
    {
<<<<<<< HEAD
        $this->iterator = $traversable instanceof Iterator ? $traversable : new IteratorIterator($traversable);
=======
        $this->iterator = new IteratorIterator($traversable);
>>>>>>> forked/LAE_400_PACKAGE
        $this->callback = $callback;
    }

    /**
<<<<<<< HEAD
     * @see https://php.net/iterator.current
     * @return mixed
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/iterator.current
     * @return mixed
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function current()
    {
        return ($this->callback)($this->iterator->current());
    }

    /**
<<<<<<< HEAD
     * @see https://php.net/iterator.key
     * @return mixed
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/iterator.key
     * @return mixed
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function key()
    {
        return $this->iterator->key();
    }

    /**
<<<<<<< HEAD
     * @see https://php.net/iterator.next
     */
    public function next(): void
=======
     * @see http://php.net/iterator.next
     * @return void
     */
    public function next()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $this->iterator->next();
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
        $this->iterator->rewind();
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
        return $this->iterator->valid();
    }
}
