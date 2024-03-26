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

<<<<<<< HEAD
use MongoDB\Driver\Cursor;
=======
>>>>>>> forked/LAE_400_PACKAGE
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnexpectedValueException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

use function array_intersect_key;
use function assert;
=======
use function array_intersect_key;
>>>>>>> forked/LAE_400_PACKAGE
use function count;
use function current;
use function is_array;
use function is_float;
use function is_integer;
use function is_object;

/**
 * Operation for obtaining an exact count of documents in a collection
 *
 * @api
 * @see \MongoDB\Collection::countDocuments()
 * @see https://github.com/mongodb/specifications/blob/master/source/crud/crud.rst#countdocuments
 */
class CountDocuments implements Executable
{
    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array|object */
    private $filter;

    /** @var array */
    private $aggregateOptions;

    /** @var array */
    private $countOptions;

    /** @var Aggregate */
    private $aggregate;

    /**
     * Constructs an aggregate command for counting documents
     *
     * Supported options:
     *
     *  * collation (document): Collation specification.
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    Only string values are supported for server versions < 4.4.
=======
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * hint (string|document): The index to use. Specify either the index
     *    name as a string or the index key pattern as a document. If specified,
     *    then the query system will only consider plans using the hinted index.
     *
     *  * limit (integer): The maximum number of documents to count.
     *
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
     *  * skip (integer): The number of documents to skip before returning the
     *    documents.
     *
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

        if (isset($options['limit']) && ! is_integer($options['limit'])) {
            throw InvalidArgumentException::invalidType('"limit" option', $options['limit'], 'integer');
        }

        if (isset($options['skip']) && ! is_integer($options['skip'])) {
            throw InvalidArgumentException::invalidType('"skip" option', $options['skip'], 'integer');
        }

<<<<<<< HEAD
        $this->databaseName = $databaseName;
        $this->collectionName = $collectionName;
        $this->filter = $filter;

        $this->aggregateOptions = array_intersect_key($options, ['collation' => 1, 'comment' => 1, 'hint' => 1, 'maxTimeMS' => 1, 'readConcern' => 1, 'readPreference' => 1, 'session' => 1]);
=======
        $this->databaseName = (string) $databaseName;
        $this->collectionName = (string) $collectionName;
        $this->filter = $filter;

        $this->aggregateOptions = array_intersect_key($options, ['collation' => 1, 'hint' => 1, 'maxTimeMS' => 1, 'readConcern' => 1, 'readPreference' => 1, 'session' => 1]);
>>>>>>> forked/LAE_400_PACKAGE
        $this->countOptions = array_intersect_key($options, ['limit' => 1, 'skip' => 1]);

        $this->aggregate = $this->createAggregate();
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
        $cursor = $this->aggregate->execute($server);
<<<<<<< HEAD
        assert($cursor instanceof Cursor);

=======
>>>>>>> forked/LAE_400_PACKAGE
        $allResults = $cursor->toArray();

        /* If there are no documents to count, the aggregation pipeline has no items to group, and
         * hence the result is an empty array (PHPLIB-376) */
        if (count($allResults) == 0) {
            return 0;
        }

        $result = current($allResults);
<<<<<<< HEAD
        if (! is_object($result) || ! isset($result->n) || ! (is_integer($result->n) || is_float($result->n))) {
=======
        if (! isset($result->n) || ! (is_integer($result->n) || is_float($result->n))) {
>>>>>>> forked/LAE_400_PACKAGE
            throw new UnexpectedValueException('count command did not return a numeric "n" value');
        }

        return (integer) $result->n;
    }

<<<<<<< HEAD
    private function createAggregate(): Aggregate
=======
    /**
     * @return Aggregate
     */
    private function createAggregate()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $pipeline = [
            ['$match' => (object) $this->filter],
        ];

        if (isset($this->countOptions['skip'])) {
            $pipeline[] = ['$skip' => $this->countOptions['skip']];
        }

        if (isset($this->countOptions['limit'])) {
            $pipeline[] = ['$limit' => $this->countOptions['limit']];
        }

        $pipeline[] = ['$group' => ['_id' => 1, 'n' => ['$sum' => 1]]];

        return new Aggregate($this->databaseName, $this->collectionName, $pipeline, $this->aggregateOptions);
    }
}
