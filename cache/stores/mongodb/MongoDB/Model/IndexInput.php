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

use MongoDB\BSON\Serializable;
use MongoDB\Exception\InvalidArgumentException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function is_array;
use function is_float;
use function is_int;
use function is_object;
use function is_string;
use function MongoDB\generate_index_name;
use function sprintf;

/**
 * Index input model class.
 *
 * This class is used to validate user input for index creation.
 *
 * @internal
 * @see \MongoDB\Collection::createIndexes()
 * @see https://github.com/mongodb/specifications/blob/master/source/enumerate-indexes.rst
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/method/db.collection.createIndex/
=======
 * @see http://docs.mongodb.org/manual/reference/method/db.collection.createIndex/
>>>>>>> forked/LAE_400_PACKAGE
 */
class IndexInput implements Serializable
{
    /** @var array */
    private $index;

    /**
     * @param array $index Index specification
     * @throws InvalidArgumentException
     */
    public function __construct(array $index)
    {
        if (! isset($index['key'])) {
            throw new InvalidArgumentException('Required "key" document is missing from index specification');
        }

        if (! is_array($index['key']) && ! is_object($index['key'])) {
            throw InvalidArgumentException::invalidType('"key" option', $index['key'], 'array or object');
        }

        foreach ($index['key'] as $fieldName => $order) {
            if (! is_int($order) && ! is_float($order) && ! is_string($order)) {
                throw InvalidArgumentException::invalidType(sprintf('order value for "%s" field within "key" option', $fieldName), $order, 'numeric or string');
            }
        }

        if (! isset($index['name'])) {
            $index['name'] = generate_index_name($index['key']);
        }

        if (! is_string($index['name'])) {
            throw InvalidArgumentException::invalidType('"name" option', $index['name'], 'string');
        }

        $this->index = $index;
    }

    /**
     * Return the index name.
<<<<<<< HEAD
     */
    public function __toString(): string
=======
     *
     * @return string
     */
    public function __toString()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->index['name'];
    }

    /**
     * Serialize the index information to BSON for index creation.
     *
     * @see \MongoDB\Collection::createIndexes()
<<<<<<< HEAD
     * @see https://php.net/mongodb-bson-serializable.bsonserialize
     */
    public function bsonSerialize(): array
=======
     * @see http://php.net/mongodb-bson-serializable.bsonserialize
     * @return array
     */
    public function bsonSerialize()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->index;
    }
}
