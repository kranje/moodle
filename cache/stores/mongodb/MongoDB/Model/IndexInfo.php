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

use ArrayAccess;
use MongoDB\Exception\BadMethodCallException;
<<<<<<< HEAD
use ReturnTypeWillChange;

=======
>>>>>>> forked/LAE_400_PACKAGE
use function array_key_exists;
use function array_search;

/**
 * Index information model class.
 *
 * This class models the index information returned by the listIndexes command
 * or, for legacy servers, queries on the "system.indexes" collection. It
 * provides methods to access common index options, and allows access to other
 * options through the ArrayAccess interface (write methods are not supported).
 * For information on keys and index options, see the referenced
 * db.collection.createIndex() documentation.
 *
 * @api
 * @see \MongoDB\Collection::listIndexes()
 * @see https://github.com/mongodb/specifications/blob/master/source/enumerate-indexes.rst
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/method/db.collection.createIndex/
=======
 * @see http://docs.mongodb.org/manual/reference/method/db.collection.createIndex/
>>>>>>> forked/LAE_400_PACKAGE
 */
class IndexInfo implements ArrayAccess
{
    /** @var array */
    private $info;

    /**
     * @param array $info Index info
     */
    public function __construct(array $info)
    {
        $this->info = $info;
    }

    /**
     * Return the collection info as an array.
     *
<<<<<<< HEAD
     * @see https://php.net/oop5.magic#language.oop5.magic.debuginfo
=======
     * @see http://php.net/oop5.magic#language.oop5.magic.debuginfo
>>>>>>> forked/LAE_400_PACKAGE
     * @return array
     */
    public function __debugInfo()
    {
        return $this->info;
    }

    /**
     * Return the index name to allow casting IndexInfo to string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Return the index key.
     *
     * @return array
     */
    public function getKey()
    {
        return (array) $this->info['key'];
    }

    /**
     * Return the index name.
     *
     * @return string
     */
    public function getName()
    {
        return (string) $this->info['name'];
    }

    /**
     * Return the index namespace (e.g. "db.collection").
     *
     * @return string
     */
    public function getNamespace()
    {
        return (string) $this->info['ns'];
    }

    /**
     * Return the index version.
     *
     * @return integer
     */
    public function getVersion()
    {
        return (integer) $this->info['v'];
    }

    /**
     * Return whether or not this index is of type 2dsphere.
     *
     * @return boolean
     */
    public function is2dSphere()
    {
        return array_search('2dsphere', $this->getKey(), true) !== false;
    }

    /**
     * Return whether or not this index is of type geoHaystack.
     *
     * @return boolean
     */
    public function isGeoHaystack()
    {
        return array_search('geoHaystack', $this->getKey(), true) !== false;
    }

    /**
     * Return whether this is a sparse index.
     *
<<<<<<< HEAD
     * @see https://mongodb.com/docs/manual/core/index-sparse/
=======
     * @see http://docs.mongodb.org/manual/core/index-sparse/
>>>>>>> forked/LAE_400_PACKAGE
     * @return boolean
     */
    public function isSparse()
    {
        return ! empty($this->info['sparse']);
    }

    /**
     * Return whether or not this index is of type text.
     *
     * @return boolean
     */
    public function isText()
    {
        return array_search('text', $this->getKey(), true) !== false;
    }

    /**
     * Return whether this is a TTL index.
     *
<<<<<<< HEAD
     * @see https://mongodb.com/docs/manual/core/index-ttl/
=======
     * @see http://docs.mongodb.org/manual/core/index-ttl/
>>>>>>> forked/LAE_400_PACKAGE
     * @return boolean
     */
    public function isTtl()
    {
        return array_key_exists('expireAfterSeconds', $this->info);
    }

    /**
     * Return whether this is a unique index.
     *
<<<<<<< HEAD
     * @see https://mongodb.com/docs/manual/core/index-unique/
=======
     * @see http://docs.mongodb.org/manual/core/index-unique/
>>>>>>> forked/LAE_400_PACKAGE
     * @return boolean
     */
    public function isUnique()
    {
        return ! empty($this->info['unique']);
    }

    /**
     * Check whether a field exists in the index information.
     *
<<<<<<< HEAD
     * @see https://php.net/arrayaccess.offsetexists
     * @param mixed $key
     * @return boolean
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/arrayaccess.offsetexists
     * @param mixed $key
     * @return boolean
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->info);
    }

    /**
     * Return the field's value from the index information.
     *
     * This method satisfies the Enumerating Indexes specification's requirement
     * that index fields be made accessible under their original names. It may
     * also be used to access fields that do not have a helper method.
     *
<<<<<<< HEAD
     * @see https://php.net/arrayaccess.offsetget
=======
     * @see http://php.net/arrayaccess.offsetget
>>>>>>> forked/LAE_400_PACKAGE
     * @see https://github.com/mongodb/specifications/blob/master/source/enumerate-indexes.rst#getting-full-index-information
     * @param mixed $key
     * @return mixed
     */
<<<<<<< HEAD
    #[ReturnTypeWillChange]
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function offsetGet($key)
    {
        return $this->info[$key];
    }

    /**
     * Not supported.
     *
<<<<<<< HEAD
     * @see https://php.net/arrayaccess.offsetset
     * @param mixed $key
     * @param mixed $value
     * @throws BadMethodCallException
     * @return void
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/arrayaccess.offsetset
     * @param mixed $key
     * @param mixed $value
     * @throws BadMethodCallException
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function offsetSet($key, $value)
    {
        throw BadMethodCallException::classIsImmutable(self::class);
    }

    /**
     * Not supported.
     *
<<<<<<< HEAD
     * @see https://php.net/arrayaccess.offsetunset
     * @param mixed $key
     * @throws BadMethodCallException
     * @return void
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/arrayaccess.offsetunset
     * @param mixed $key
     * @throws BadMethodCallException
     */
>>>>>>> forked/LAE_400_PACKAGE
    public function offsetUnset($key)
    {
        throw BadMethodCallException::classIsImmutable(self::class);
    }
}
