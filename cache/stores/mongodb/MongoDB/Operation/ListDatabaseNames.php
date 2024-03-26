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

namespace MongoDB\Operation;

use ArrayIterator;
use Iterator;
use MongoDB\Command\ListDatabases as ListDatabasesCommand;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnexpectedValueException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function array_column;

/**
 * Operation for the ListDatabases command, returning only database names.
 *
 * @api
 * @see \MongoDB\Client::listDatabaseNames()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/listDatabases/#mongodb-dbcommand-dbcmd.listDatabases
=======
 * @see http://docs.mongodb.org/manual/reference/command/ListDatabases/
>>>>>>> forked/LAE_400_PACKAGE
 */
class ListDatabaseNames implements Executable
{
    /** @var ListDatabasesCommand */
    private $listDatabases;

    /**
     * Constructs a listDatabases command.
     *
     * Supported options:
     *
     *  * authorizedDatabases (boolean): Determines which databases are returned
     *    based on the user privileges.
     *
     *    For servers < 4.0.5, this option is ignored.
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
     *
     *  * filter (document): Query by which to filter databases.
     *
=======
     *  * filter (document): Query by which to filter databases.
     *
     *    For servers < 3.6, this option is ignored.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param array $options Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
    public function __construct(array $options = [])
    {
        $this->listDatabases = new ListDatabasesCommand(['nameOnly' => true] + $options);
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @throws UnexpectedValueException if the command response was malformed
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server): Iterator
=======
     * @param Server $server
     * @return Iterator
     * @throws UnexpectedValueException if the command response was malformed
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server) : Iterator
>>>>>>> forked/LAE_400_PACKAGE
    {
        $result = $this->listDatabases->execute($server);

        return new ArrayIterator(array_column($result, 'name'));
    }
}
