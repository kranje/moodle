<?php
/*
<<<<<<< HEAD
 * Copyright 2018-present MongoDB, Inc.
=======
 * Copyright 2018 MongoDB, Inc.
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

use MongoDB\Driver\Command;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Driver\WriteConcern;
use MongoDB\Exception\InvalidArgumentException;
<<<<<<< HEAD

use function current;
use function is_array;
=======
use MongoDB\Exception\UnsupportedException;
use function current;
use function is_array;
use function MongoDB\server_supports_feature;
>>>>>>> forked/LAE_400_PACKAGE

/**
 * Operation for the collMod command.
 *
 * @api
 * @see \MongoDB\Database::modifyCollection()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/collMod/
=======
 * @see http://docs.mongodb.org/manual/reference/command/collMod/
>>>>>>> forked/LAE_400_PACKAGE
 */
class ModifyCollection implements Executable
{
    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array */
    private $collectionOptions;

    /** @var array */
    private $options;

    /**
     * Constructs a collMod command.
     *
     * Supported options:
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
=======
     *  * session (MongoDB\Driver\Session): Client session.
     *
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * typeMap (array): Type map for BSON deserialization. This will only be
     *    used for the returned command result document.
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.2 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param string $databaseName      Database name
     * @param string $collectionName    Collection or view to modify
     * @param array  $collectionOptions Collection or view options to assign
     * @param array  $options           Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, array $collectionOptions, array $options = [])
=======
    public function __construct($databaseName, $collectionName, array $collectionOptions, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (empty($collectionOptions)) {
            throw new InvalidArgumentException('$collectionOptions is empty');
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['typeMap']) && ! is_array($options['typeMap'])) {
            throw InvalidArgumentException::invalidType('"typeMap" option', $options['typeMap'], 'array');
        }

        if (isset($options['writeConcern']) && ! $options['writeConcern'] instanceof WriteConcern) {
            throw InvalidArgumentException::invalidType('"writeConcern" option', $options['writeConcern'], WriteConcern::class);
        }

        if (isset($options['writeConcern']) && $options['writeConcern']->isDefault()) {
            unset($options['writeConcern']);
        }

<<<<<<< HEAD
        $this->databaseName = $databaseName;
        $this->collectionName = $collectionName;
=======
        $this->databaseName = (string) $databaseName;
        $this->collectionName = (string) $collectionName;
>>>>>>> forked/LAE_400_PACKAGE
        $this->collectionOptions = $collectionOptions;
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
=======
     * @param Server $server
>>>>>>> forked/LAE_400_PACKAGE
     * @return array|object Command result document
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
<<<<<<< HEAD
        $cursor = $server->executeWriteCommand($this->databaseName, $this->createCommand(), $this->createOptions());
=======
        if (isset($this->options['writeConcern']) && ! server_supports_feature($server, self::$wireVersionForWriteConcern)) {
            throw UnsupportedException::writeConcernNotSupported();
        }

        $cursor = $server->executeWriteCommand($this->databaseName, new Command(['collMod' => $this->collectionName] + $this->collectionOptions), $this->createOptions());
>>>>>>> forked/LAE_400_PACKAGE

        if (isset($this->options['typeMap'])) {
            $cursor->setTypeMap($this->options['typeMap']);
        }

        return current($cursor->toArray());
    }

<<<<<<< HEAD
    private function createCommand(): Command
    {
        $cmd = ['collMod' => $this->collectionName] + $this->collectionOptions;

        if (isset($this->options['comment'])) {
            $cmd['comment'] = $this->options['comment'];
        }

        return new Command($cmd);
    }

    /**
     * Create options for executing the command.
     *
     * @see https://php.net/manual/en/mongodb-driver-server.executewritecommand.php
     */
    private function createOptions(): array
=======
    /**
     * Create options for executing the command.
     *
     * @see http://php.net/manual/en/mongodb-driver-server.executewritecommand.php
     * @return array
     */
    private function createOptions()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $options = [];

        if (isset($this->options['session'])) {
            $options['session'] = $this->options['session'];
        }

        if (isset($this->options['writeConcern'])) {
            $options['writeConcern'] = $this->options['writeConcern'];
        }

        return $options;
    }
}
