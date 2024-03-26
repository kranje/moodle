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

namespace MongoDB\Operation;

use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
<<<<<<< HEAD
use MongoDB\Driver\ReadConcern;
use MongoDB\Driver\ReadPreference;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnexpectedValueException;
use MongoDB\Exception\UnsupportedException;

use function array_intersect_key;
use function is_integer;
=======
use MongoDB\Driver\Server;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnexpectedValueException;
use MongoDB\Exception\UnsupportedException;
use function array_intersect_key;
>>>>>>> forked/LAE_400_PACKAGE

/**
 * Operation for obtaining an estimated count of documents in a collection
 *
 * @api
 * @see \MongoDB\Collection::estimatedDocumentCount()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/count/
=======
 * @see http://docs.mongodb.org/manual/reference/command/count/
>>>>>>> forked/LAE_400_PACKAGE
 */
class EstimatedDocumentCount implements Executable, Explainable
{
    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array */
    private $options;

<<<<<<< HEAD
    /** @var int */
    private static $errorCodeCollectionNotFound = 26;

    /** @var int */
    private static $wireVersionForCollStats = 12;

    /**
     * Constructs a command to get the estimated number of documents in a
     * collection.
     *
     * Supported options:
     *
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
     *
=======
    /** @var Count */
    private $count;

    /**
     * Constructs a count command.
     *
     * Supported options:
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
     *  * readConcern (MongoDB\Driver\ReadConcern): Read concern.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.2 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * readPreference (MongoDB\Driver\ReadPreference): Read preference.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param string $databaseName   Database name
     * @param string $collectionName Collection name
     * @param array  $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, array $options = [])
    {
        $this->databaseName = $databaseName;
        $this->collectionName = $collectionName;

        if (isset($options['maxTimeMS']) && ! is_integer($options['maxTimeMS'])) {
            throw InvalidArgumentException::invalidType('"maxTimeMS" option', $options['maxTimeMS'], 'integer');
        }

        if (isset($options['readConcern']) && ! $options['readConcern'] instanceof ReadConcern) {
            throw InvalidArgumentException::invalidType('"readConcern" option', $options['readConcern'], ReadConcern::class);
        }

        if (isset($options['readPreference']) && ! $options['readPreference'] instanceof ReadPreference) {
            throw InvalidArgumentException::invalidType('"readPreference" option', $options['readPreference'], ReadPreference::class);
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        $this->options = array_intersect_key($options, ['comment' => 1, 'maxTimeMS' => 1, 'readConcern' => 1, 'readPreference' => 1, 'session' => 1]);
=======
    public function __construct($databaseName, $collectionName, array $options = [])
    {
        $this->databaseName = (string) $databaseName;
        $this->collectionName = (string) $collectionName;
        $this->options = array_intersect_key($options, ['maxTimeMS' => 1, 'readConcern' => 1, 'readPreference' => 1, 'session' => 1]);

        $this->count = $this->createCount();
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
=======
     * @param Server $server
>>>>>>> forked/LAE_400_PACKAGE
     * @return integer
     * @throws UnexpectedValueException if the command response was malformed
     * @throws UnsupportedException if collation or read concern is used and unsupported
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
<<<<<<< HEAD
        return $this->createCount()->execute($server);
    }

    /**
     * Returns the command document for this operation.
     *
     * @see Explainable::getCommandDocument()
     * @return array
     */
    public function getCommandDocument(Server $server)
    {
        return $this->createCount()->getCommandDocument($server);
    }

    private function createCount(): Count
=======
        return $this->count->execute($server);
    }

    public function getCommandDocument(Server $server)
    {
        return $this->count->getCommandDocument($server);
    }

    /**
     * @return Count
     */
    private function createCount()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return new Count($this->databaseName, $this->collectionName, [], $this->options);
    }
}
