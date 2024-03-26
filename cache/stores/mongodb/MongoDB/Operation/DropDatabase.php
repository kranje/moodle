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
 * Operation for the dropDatabase command.
 *
 * @api
 * @see \MongoDB\Client::dropDatabase()
 * @see \MongoDB\Database::drop()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/dropDatabase/
 */
class DropDatabase implements Executable
{
=======
 * @see http://docs.mongodb.org/manual/reference/command/dropDatabase/
 */
class DropDatabase implements Executable
{
    /** @var integer */
    private static $wireVersionForWriteConcern = 5;

>>>>>>> forked/LAE_400_PACKAGE
    /** @var string */
    private $databaseName;

    /** @var array */
    private $options;

    /**
     * Constructs a dropDatabase command.
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
     *  * typeMap (array): Type map for BSON deserialization. This will be used
     *    for the returned command result document.
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param string $databaseName Database name
     * @param array  $options      Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, array $options = [])
=======
    public function __construct($databaseName, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
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
=======
        $this->databaseName = (string) $databaseName;
>>>>>>> forked/LAE_400_PACKAGE
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @return array|object Command result document
=======
     * @param Server $server
     * @return array|object Command result document
     * @throws UnsupportedException if writeConcern is used and unsupported
>>>>>>> forked/LAE_400_PACKAGE
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

        $command = new Command(['dropDatabase' => 1]);
        $cursor = $server->executeWriteCommand($this->databaseName, $command, $this->createOptions());
>>>>>>> forked/LAE_400_PACKAGE

        if (isset($this->options['typeMap'])) {
            $cursor->setTypeMap($this->options['typeMap']);
        }

        return current($cursor->toArray());
    }

    /**
<<<<<<< HEAD
     * Create the dropDatabase command.
     */
    private function createCommand(): Command
    {
        $cmd = ['dropDatabase' => 1];

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
