<?php
/*
<<<<<<< HEAD
 * Copyright 2015-present MongoDB, Inc.
=======
 * Copyright 2015-2017 MongoDB, Inc.
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

use function current;
use function key;
use function next;
use function reset;

/**
 * DatabaseInfoIterator for inline listDatabases command results.
 *
 * This iterator may be used to wrap the array returned within the listDatabases
 * command's single-document result.
 *
 * @internal
 * @see \MongoDB\Client::listDatabases()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/listDatabases/
=======
 * @see http://docs.mongodb.org/manual/reference/command/listDatabases/
>>>>>>> forked/LAE_400_PACKAGE
 */
class DatabaseInfoLegacyIterator implements DatabaseInfoIterator
{
    /** @var array */
    private $databases;

<<<<<<< HEAD
=======
    /**
     * @param array $databases
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function __construct(array $databases)
    {
        $this->databases = $databases;
    }

    /**
     * Return the current element as a DatabaseInfo instance.
     *
     * @see DatabaseInfoIterator::current()
<<<<<<< HEAD
     * @see https://php.net/iterator.current
     */
    public function current(): DatabaseInfo
=======
     * @see http://php.net/iterator.current
     * @return DatabaseInfo
     */
    public function current()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new DatabaseInfo(current($this->databases));
    }

    /**
     * Return the key of the current element.
     *
<<<<<<< HEAD
     * @see https://php.net/iterator.key
     */
    public function key(): int
=======
     * @see http://php.net/iterator.key
     * @return integer
     */
    public function key()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return key($this->databases);
    }

    /**
     * Move forward to next element.
     *
<<<<<<< HEAD
     * @see https://php.net/iterator.next
     */
    public function next(): void
=======
     * @see http://php.net/iterator.next
     */
    public function next()
>>>>>>> forked/LAE_400_PACKAGE
    {
        next($this->databases);
    }

    /**
     * Rewind the Iterator to the first element.
     *
<<<<<<< HEAD
     * @see https://php.net/iterator.rewind
     */
    public function rewind(): void
=======
     * @see http://php.net/iterator.rewind
     */
    public function rewind()
>>>>>>> forked/LAE_400_PACKAGE
    {
        reset($this->databases);
    }

    /**
     * Checks if current position is valid.
     *
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
        return key($this->databases) !== null;
    }
}
