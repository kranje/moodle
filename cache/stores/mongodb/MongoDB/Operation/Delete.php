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

use MongoDB\DeleteResult;
use MongoDB\Driver\BulkWrite as Bulk;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Driver\WriteConcern;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

use function is_array;
use function is_object;
use function is_string;
use function MongoDB\is_write_concern_acknowledged;
=======
use function is_array;
use function is_object;
use function is_string;
>>>>>>> forked/LAE_400_PACKAGE
use function MongoDB\server_supports_feature;

/**
 * Operation for the delete command.
 *
 * This class is used internally by the DeleteMany and DeleteOne operation
 * classes.
 *
 * @internal
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/delete/
=======
 * @see http://docs.mongodb.org/manual/reference/command/delete/
>>>>>>> forked/LAE_400_PACKAGE
 */
class Delete implements Executable, Explainable
{
    /** @var integer */
<<<<<<< HEAD
    private static $wireVersionForHint = 9;
=======
    private static $wireVersionForCollation = 5;

    /** @var int */
    private static $wireVersionForHintServerSideError = 5;
>>>>>>> forked/LAE_400_PACKAGE

    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array|object */
    private $filter;

    /** @var integer */
    private $limit;

    /** @var array */
    private $options;

    /**
     * Constructs a delete command.
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
<<<<<<< HEAD
     *  * let (document): Map of parameter names and values. Values must be
     *    constant or closed expressions that do not reference document fields.
     *    Parameters can then be accessed as variables in an aggregate
     *    expression context (e.g. "$$var").
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
=======
     *  * session (MongoDB\Driver\Session): Client session.
     *
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     * @param string       $databaseName   Database name
     * @param string       $collectionName Collection name
     * @param array|object $filter         Query by which to delete documents
     * @param integer      $limit          The number of matching documents to
     *                                     delete. Must be 0 or 1, for all or a
     *                                     single document, respectively.
     * @param array        $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, $filter, int $limit, array $options = [])
=======
    public function __construct($databaseName, $collectionName, $filter, $limit, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! is_array($filter) && ! is_object($filter)) {
            throw InvalidArgumentException::invalidType('$filter', $filter, 'array or object');
        }

        if ($limit !== 0 && $limit !== 1) {
            throw new InvalidArgumentException('$limit must be 0 or 1');
        }

        if (isset($options['collation']) && ! is_array($options['collation']) && ! is_object($options['collation'])) {
            throw InvalidArgumentException::invalidType('"collation" option', $options['collation'], 'array or object');
        }

        if (isset($options['hint']) && ! is_string($options['hint']) && ! is_array($options['hint']) && ! is_object($options['hint'])) {
            throw InvalidArgumentException::invalidType('"hint" option', $options['hint'], ['string', 'array', 'object']);
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['writeConcern']) && ! $options['writeConcern'] instanceof WriteConcern) {
            throw InvalidArgumentException::invalidType('"writeConcern" option', $options['writeConcern'], WriteConcern::class);
        }

<<<<<<< HEAD
        if (isset($options['let']) && ! is_array($options['let']) && ! is_object($options['let'])) {
            throw InvalidArgumentException::invalidType('"let" option', $options['let'], 'array or object');
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
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
        $this->filter = $filter;
        $this->limit = $limit;
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @return DeleteResult
     * @throws UnsupportedException if hint or write concern is used and unsupported
=======
     * @param Server $server
     * @return DeleteResult
>>>>>>> forked/LAE_400_PACKAGE
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
<<<<<<< HEAD
        /* CRUD spec requires a client-side error when using "hint" with an
         * unacknowledged write concern on an unsupported server. */
        if (
            isset($this->options['writeConcern']) && ! is_write_concern_acknowledged($this->options['writeConcern']) &&
            isset($this->options['hint']) && ! server_supports_feature($server, self::$wireVersionForHint)
        ) {
=======
        if (isset($this->options['collation']) && ! server_supports_feature($server, self::$wireVersionForCollation)) {
            throw UnsupportedException::collationNotSupported();
        }

        /* Server versions >= 3.4.0 raise errors for unknown update
         * options. For previous versions, the CRUD spec requires a client-side
         * error. */
        if (isset($this->options['hint']) && ! server_supports_feature($server, self::$wireVersionForHintServerSideError)) {
>>>>>>> forked/LAE_400_PACKAGE
            throw UnsupportedException::hintNotSupported();
        }

        $inTransaction = isset($this->options['session']) && $this->options['session']->isInTransaction();
        if ($inTransaction && isset($this->options['writeConcern'])) {
            throw UnsupportedException::writeConcernNotSupportedInTransaction();
        }

<<<<<<< HEAD
        $bulk = new Bulk($this->createBulkWriteOptions());
=======
        $bulk = new Bulk();
>>>>>>> forked/LAE_400_PACKAGE
        $bulk->delete($this->filter, $this->createDeleteOptions());

        $writeResult = $server->executeBulkWrite($this->databaseName . '.' . $this->collectionName, $bulk, $this->createExecuteOptions());

        return new DeleteResult($writeResult);
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
        $cmd = ['delete' => $this->collectionName, 'deletes' => [['q' => $this->filter] + $this->createDeleteOptions()]];

        if (isset($this->options['writeConcern'])) {
            $cmd['writeConcern'] = $this->options['writeConcern'];
        }

        return $cmd;
    }

    /**
<<<<<<< HEAD
     * Create options for constructing the bulk write.
     *
     * @see https://php.net/manual/en/mongodb-driver-bulkwrite.construct.php
     */
    private function createBulkWriteOptions(): array
    {
        $options = [];

        if (isset($this->options['comment'])) {
            $options['comment'] = $this->options['comment'];
        }

        if (isset($this->options['let'])) {
            $options['let'] = (object) $this->options['let'];
        }

        return $options;
    }

    /**
=======
>>>>>>> forked/LAE_400_PACKAGE
     * Create options for the delete command.
     *
     * Note that these options are different from the bulk write options, which
     * are created in createExecuteOptions().
<<<<<<< HEAD
     */
    private function createDeleteOptions(): array
=======
     *
     * @return array
     */
    private function createDeleteOptions()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $deleteOptions = ['limit' => $this->limit];

        if (isset($this->options['collation'])) {
            $deleteOptions['collation'] = (object) $this->options['collation'];
        }

        if (isset($this->options['hint'])) {
            $deleteOptions['hint'] = $this->options['hint'];
        }

        return $deleteOptions;
    }

    /**
     * Create options for executing the bulk write.
     *
<<<<<<< HEAD
     * @see https://php.net/manual/en/mongodb-driver-server.executebulkwrite.php
     */
    private function createExecuteOptions(): array
=======
     * @see http://php.net/manual/en/mongodb-driver-server.executebulkwrite.php
     * @return array
     */
    private function createExecuteOptions()
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
