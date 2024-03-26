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
use MongoDB\Driver\Server;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function is_array;
use function is_object;

/**
 * Operation for deleting a document with the findAndModify command.
 *
 * @api
 * @see \MongoDB\Collection::findOneAndDelete()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/findAndModify/
=======
 * @see http://docs.mongodb.org/manual/reference/command/findAndModify/
>>>>>>> forked/LAE_400_PACKAGE
 */
class FindOneAndDelete implements Executable, Explainable
{
    /** @var FindAndModify */
    private $findAndModify;

    /**
     * Constructs a findAndModify command for deleting a document.
     *
     * Supported options:
     *
     *  * collation (document): Collation specification.
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
=======
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * hint (string|document): The index to use. Specify either the index
     *    name as a string or the index key pattern as a document. If specified,
     *    then the query system will only consider plans using the hinted index.
     *
     *    This is not supported for server versions < 4.4 and will result in an
     *    exception at execution time if used.
     *
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
     *  * projection (document): Limits the fields to return for the matching
     *    document.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
     *  * sort (document): Determines which document the operation modifies if
     *    the query selects multiple documents.
     *
     *  * let (document): Map of parameter names and values. Values must be
     *    constant or closed expressions that do not reference document fields.
     *    Parameters can then be accessed as variables in an aggregate
     *    expression context (e.g. "$$var").
     *
=======
     *    Sessions are not supported for server versions < 3.6.
     *
     *  * sort (document): Determines which document the operation modifies if
     *    the query selects multiple documents.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * typeMap (array): Type map for BSON deserialization.
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.2 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param string       $databaseName   Database name
     * @param string       $collectionName Collection name
     * @param array|object $filter         Query by which to filter documents
     * @param array        $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, $filter, array $options = [])
=======
    public function __construct($databaseName, $collectionName, $filter, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! is_array($filter) && ! is_object($filter)) {
            throw InvalidArgumentException::invalidType('$filter', $filter, 'array or object');
        }

        if (isset($options['projection']) && ! is_array($options['projection']) && ! is_object($options['projection'])) {
            throw InvalidArgumentException::invalidType('"projection" option', $options['projection'], 'array or object');
        }

        if (isset($options['projection'])) {
            $options['fields'] = $options['projection'];
        }

        unset($options['projection']);

        $this->findAndModify = new FindAndModify(
            $databaseName,
            $collectionName,
            ['query' => $filter, 'remove' => true] + $options
        );
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
=======
     * @param Server $server
>>>>>>> forked/LAE_400_PACKAGE
     * @return array|object|null
     * @throws UnsupportedException if collation or write concern is used and unsupported
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
        return $this->findAndModify->execute($server);
    }

<<<<<<< HEAD
    /**
     * Returns the command document for this operation.
     *
     * @see Explainable::getCommandDocument()
     * @return array
     */
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function getCommandDocument(Server $server)
    {
        return $this->findAndModify->getCommandDocument($server);
    }
}
