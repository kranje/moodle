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

use MongoDB\Command\ListCollections as ListCollectionsCommand;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Model\CollectionInfoCommandIterator;
use MongoDB\Model\CollectionInfoIterator;

/**
 * Operation for the listCollections command.
 *
 * @api
 * @see \MongoDB\Database::listCollections()
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

    /** @var ListCollectionsCommand */
    private $listCollections;

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
        $this->databaseName = $databaseName;
=======
    public function __construct($databaseName, array $options = [])
    {
        $this->databaseName = (string) $databaseName;
>>>>>>> forked/LAE_400_PACKAGE
        $this->listCollections = new ListCollectionsCommand($databaseName, ['nameOnly' => false] + $options);
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
=======
     * @param Server $server
>>>>>>> forked/LAE_400_PACKAGE
     * @return CollectionInfoIterator
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
        return new CollectionInfoCommandIterator($this->listCollections->execute($server), $this->databaseName);
    }
}
