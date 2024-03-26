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
use MongoDB\Driver\Cursor;
use MongoDB\Driver\ReadPreference;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Exception\InvalidArgumentException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function is_array;
use function is_object;

/**
 * Operation for executing a database command.
 *
 * @api
 * @see \MongoDB\Database::command()
 */
class DatabaseCommand implements Executable
{
    /** @var string */
    private $databaseName;

<<<<<<< HEAD
    /** @var Command */
=======
    /** @var array|Command|object */
>>>>>>> forked/LAE_400_PACKAGE
    private $command;

    /** @var array */
    private $options;

    /**
     * Constructs a command.
     *
     * Supported options:
     *
     *  * readPreference (MongoDB\Driver\ReadPreference): The read preference to
     *    use when executing the command. This may be used when issuing the
     *    command to a replica set or mongos node to ensure that the driver sets
     *    the wire protocol accordingly or adds the read preference to the
     *    command document, respectively.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * typeMap (array): Type map for BSON deserialization. This will be
     *    applied to the returned Cursor (it is not sent to the server).
     *
     * @param string       $databaseName Database name
     * @param array|object $command      Command document
     * @param array        $options      Options for command execution
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, $command, array $options = [])
=======
    public function __construct($databaseName, $command, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! is_array($command) && ! is_object($command)) {
            throw InvalidArgumentException::invalidType('$command', $command, 'array or object');
        }

        if (isset($options['readPreference']) && ! $options['readPreference'] instanceof ReadPreference) {
            throw InvalidArgumentException::invalidType('"readPreference" option', $options['readPreference'], ReadPreference::class);
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['typeMap']) && ! is_array($options['typeMap'])) {
            throw InvalidArgumentException::invalidType('"typeMap" option', $options['typeMap'], 'array');
        }

<<<<<<< HEAD
        $this->databaseName = $databaseName;
=======
        $this->databaseName = (string) $databaseName;
>>>>>>> forked/LAE_400_PACKAGE
        $this->command = $command instanceof Command ? $command : new Command($command);
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
     * @return Cursor
     */
    public function execute(Server $server)
    {
        $cursor = $server->executeCommand($this->databaseName, $this->command, $this->createOptions());

        if (isset($this->options['typeMap'])) {
            $cursor->setTypeMap($this->options['typeMap']);
        }

        return $cursor;
    }

    /**
     * Create options for executing the command.
     *
<<<<<<< HEAD
     * @see https://php.net/manual/en/mongodb-driver-server.executecommand.php
     */
    private function createOptions(): array
=======
     * @see http://php.net/manual/en/mongodb-driver-server.executecommand.php
     * @return array
     */
    private function createOptions()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $options = [];

        if (isset($this->options['readPreference'])) {
            $options['readPreference'] = $this->options['readPreference'];
        }

        if (isset($this->options['session'])) {
            $options['session'] = $this->options['session'];
        }

        return $options;
    }
}
