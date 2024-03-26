<?php
/*
 * Copyright 2020-present MongoDB, Inc.
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

namespace MongoDB\Command;

use MongoDB\Driver\Command;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\CachingIterator;
use MongoDB\Operation\Executable;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function is_array;
use function is_bool;
use function is_integer;
use function is_object;

/**
 * Wrapper for the listCollections command.
 *
 * @internal
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/listCollections/
=======
 * @see http://docs.mongodb.org/manual/reference/command/listCollections/
>>>>>>> forked/LAE_400_PACKAGE
 */
class ListCollections implements Executable
{
    /** @var string */
    private $databaseName;

    /** @var array */
    private $options;

    /**
     * Constructs a listCollections command.
     *
     * Supported options:
     *
<<<<<<< HEAD
     *  * authorizedCollections (boolean): Determines which collections are
     *    returned based on the user privileges.
     *
     *    For servers < 4.0, this option is ignored.
     *
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
     *
=======
>>>>>>> forked/LAE_400_PACKAGE
     *  * filter (document): Query by which to filter collections.
     *
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
     *  * nameOnly (boolean): A flag to indicate whether the command should
     *    return just the collection/view names and type or return both the name
     *    and other information.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param string $databaseName Database name
     * @param array  $options      Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, array $options = [])
    {
        if (isset($options['authorizedCollections']) && ! is_bool($options['authorizedCollections'])) {
            throw InvalidArgumentException::invalidType('"authorizedCollections" option', $options['authorizedCollections'], 'boolean');
        }

=======
    public function __construct($databaseName, array $options = [])
    {
>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['filter']) && ! is_array($options['filter']) && ! is_object($options['filter'])) {
            throw InvalidArgumentException::invalidType('"filter" option', $options['filter'], 'array or object');
        }

        if (isset($options['maxTimeMS']) && ! is_integer($options['maxTimeMS'])) {
            throw InvalidArgumentException::invalidType('"maxTimeMS" option', $options['maxTimeMS'], 'integer');
        }

        if (isset($options['nameOnly']) && ! is_bool($options['nameOnly'])) {
            throw InvalidArgumentException::invalidType('"nameOnly" option', $options['nameOnly'], 'boolean');
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
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
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server): CachingIterator
    {
        $cursor = $server->executeReadCommand($this->databaseName, $this->createCommand(), $this->createOptions());
        $cursor->setTypeMap(['root' => 'array', 'document' => 'array']);

        return new CachingIterator($cursor);
    }

    /**
     * Create the listCollections command.
     */
    private function createCommand(): Command
=======
     * @param Server $server
     * @return CachingIterator
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $cmd = ['listCollections' => 1];

        if (! empty($this->options['filter'])) {
            $cmd['filter'] = (object) $this->options['filter'];
        }

<<<<<<< HEAD
        foreach (['authorizedCollections', 'comment', 'maxTimeMS', 'nameOnly'] as $option) {
            if (isset($this->options[$option])) {
                $cmd[$option] = $this->options[$option];
            }
        }

        return new Command($cmd);
=======
        if (isset($this->options['maxTimeMS'])) {
            $cmd['maxTimeMS'] = $this->options['maxTimeMS'];
        }

        if (isset($this->options['nameOnly'])) {
            $cmd['nameOnly'] = $this->options['nameOnly'];
        }

        $cursor = $server->executeReadCommand($this->databaseName, new Command($cmd), $this->createOptions());
        $cursor->setTypeMap(['root' => 'array', 'document' => 'array']);

        return new CachingIterator($cursor);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Create options for executing the command.
     *
     * Note: read preference is intentionally omitted, as the spec requires that
     * the command be executed on the primary.
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

        if (isset($this->options['session'])) {
            $options['session'] = $this->options['session'];
        }

        return $options;
    }
}
