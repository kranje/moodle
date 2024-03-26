<?php
/*
 * Copyright 2016-present MongoDB, Inc.
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

use ArrayObject;
use JsonSerializable;
use MongoDB\BSON\Serializable;
use MongoDB\BSON\Unserializable;
<<<<<<< HEAD
use ReturnTypeWillChange;

=======
>>>>>>> forked/LAE_400_PACKAGE
use function MongoDB\recursive_copy;

/**
 * Model class for a BSON document.
 *
 * The internal data will be cast to an object during BSON serialization to
 * ensure that it becomes a BSON document.
 *
 * @api
 */
class BSONDocument extends ArrayObject implements JsonSerializable, Serializable, Unserializable
{
    /**
     * Deep clone this BSONDocument.
     */
    public function __clone()
    {
        foreach ($this as $key => $value) {
            $this[$key] = recursive_copy($value);
        }
    }

    /**
     * This overrides the parent constructor to allow property access of entries
     * by default.
     *
<<<<<<< HEAD
     * @see https://php.net/arrayobject.construct
     */
    public function __construct(array $input = [], int $flags = ArrayObject::ARRAY_AS_PROPS, string $iteratorClass = 'ArrayIterator')
    {
        parent::__construct($input, $flags, $iteratorClass);
=======
     * @see http://php.net/arrayobject.construct
     * @param array   $input
     * @param integer $flags
     * @param string  $iterator_class
     */
    public function __construct($input = [], $flags = ArrayObject::ARRAY_AS_PROPS, $iterator_class = 'ArrayIterator')
    {
        parent::__construct($input, $flags, $iterator_class);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Factory method for var_export().
     *
<<<<<<< HEAD
     * @see https://php.net/oop5.magic#object.set-state
     * @see https://php.net/var-export
=======
     * @see http://php.net/oop5.magic#object.set-state
     * @see http://php.net/var-export
     * @param array $properties
>>>>>>> forked/LAE_400_PACKAGE
     * @return self
     */
    public static function __set_state(array $properties)
    {
        $document = new static();
        $document->exchangeArray($properties);

        return $document;
    }

    /**
     * Serialize the document to BSON.
     *
<<<<<<< HEAD
     * @see https://php.net/mongodb-bson-serializable.bsonserialize
     * @return object
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/mongodb-bson-serializable.bsonserialize
     * @return object
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function bsonSerialize()
    {
        return (object) $this->getArrayCopy();
    }

    /**
     * Unserialize the document to BSON.
     *
<<<<<<< HEAD
     * @see https://php.net/mongodb-bson-unserializable.bsonunserialize
     * @param array $data Array data
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/mongodb-bson-unserializable.bsonunserialize
     * @param array $data Array data
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function bsonUnserialize(array $data)
    {
        parent::__construct($data, ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Serialize the array to JSON.
     *
<<<<<<< HEAD
     * @see https://php.net/jsonserializable.jsonserialize
     * @return object
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/jsonserializable.jsonserialize
     * @return object
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function jsonSerialize()
    {
        return (object) $this->getArrayCopy();
    }
}
