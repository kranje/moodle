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

/**
 * Database information model class.
 *
 * This class models the database information returned by the listDatabases
 * command. It provides methods to access common database properties.
 *
 * @api
 * @see \MongoDB\Client::listDatabases()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/listDatabases/
=======
 * @see http://docs.mongodb.org/manual/reference/command/listDatabases/
>>>>>>> forked/LAE_400_PACKAGE
 */
class DatabaseInfo implements ArrayAccess
{
    /** @var array */
    private $info;

    /**
     * @param array $info Database info
     */
    public function __construct(array $info)
    {
        $this->info = $info;
    }

    /**
     * Return the database info as an array.
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
     * Return the database name.
     *
     * @return string
     */
    public function getName()
    {
        return (string) $this->info['name'];
    }

    /**
     * Return the databases size on disk (in bytes).
     *
     * @return integer
     */
    public function getSizeOnDisk()
    {
        /* The MongoDB server might return this number as an integer or float */
        return (integer) $this->info['sizeOnDisk'];
    }

    /**
     * Return whether the database is empty.
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return (boolean) $this->info['empty'];
    }

    /**
     * Check whether a field exists in the database information.
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
     * Return the field's value from the database information.
     *
<<<<<<< HEAD
     * @see https://php.net/arrayaccess.offsetget
     * @param mixed $key
     * @return mixed
     */
    #[ReturnTypeWillChange]
=======
     * @see http://php.net/arrayaccess.offsetget
     * @param mixed $key
     * @return mixed
     */
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
