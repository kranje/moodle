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

use IteratorIterator;
use Traversable;

/**
 * CollectionInfoIterator for listCollections command results.
 *
 * This iterator may be used to wrap a Cursor returned by the listCollections
 * command.
 *
 * @internal
 * @see \MongoDB\Database::listCollections()
 * @see https://github.com/mongodb/specifications/blob/master/source/enumerate-collections.rst
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/listCollections/
=======
 * @see http://docs.mongodb.org/manual/reference/command/listCollections/
>>>>>>> forked/LAE_400_PACKAGE
 */
class CollectionInfoCommandIterator extends IteratorIterator implements CollectionInfoIterator
{
    /** @var string|null */
    private $databaseName;

<<<<<<< HEAD
    public function __construct(Traversable $iterator, ?string $databaseName = null)
=======
    /**
     * @param string|null $databaseName
     */
    public function __construct(Traversable $iterator, $databaseName = null)
>>>>>>> forked/LAE_400_PACKAGE
    {
        parent::__construct($iterator);

        $this->databaseName = $databaseName;
    }

    /**
     * Return the current element as a CollectionInfo instance.
     *
     * @see CollectionInfoIterator::current()
<<<<<<< HEAD
     * @see https://php.net/iterator.current
     */
    public function current(): CollectionInfo
=======
     * @see http://php.net/iterator.current
     * @return CollectionInfo
     */
    public function current()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $info = parent::current();

        if ($this->databaseName !== null && isset($info['idIndex']) && ! isset($info['idIndex']['ns'])) {
            $info['idIndex']['ns'] = $this->databaseName . '.' . $info['name'];
        }

        return new CollectionInfo($info);
    }
}
