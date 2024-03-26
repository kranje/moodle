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

use MongoDB\BulkWriteResult;
use MongoDB\Driver\BulkWrite as Bulk;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Driver\WriteConcern;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function array_key_exists;
use function count;
use function current;
use function is_array;
use function is_bool;
use function is_object;
use function key;
use function MongoDB\is_first_key_operator;
use function MongoDB\is_pipeline;
<<<<<<< HEAD
=======
use function MongoDB\server_supports_feature;
>>>>>>> forked/LAE_400_PACKAGE
use function sprintf;

/**
 * Operation for executing multiple write operations.
 *
 * @api
 * @see \MongoDB\Collection::bulkWrite()
 */
class BulkWrite implements Executable
{
<<<<<<< HEAD
    public const DELETE_MANY = 'deleteMany';
    public const DELETE_ONE  = 'deleteOne';
    public const INSERT_ONE  = 'insertOne';
    public const REPLACE_ONE = 'replaceOne';
    public const UPDATE_MANY = 'updateMany';
    public const UPDATE_ONE  = 'updateOne';
=======
    const DELETE_MANY = 'deleteMany';
    const DELETE_ONE  = 'deleteOne';
    const INSERT_ONE  = 'insertOne';
    const REPLACE_ONE = 'replaceOne';
    const UPDATE_MANY = 'updateMany';
    const UPDATE_ONE  = 'updateOne';

    /** @var integer */
    private static $wireVersionForArrayFilters = 6;

    /** @var integer */
    private static $wireVersionForCollation = 5;

    /** @var integer */
    private static $wireVersionForDocumentLevelValidation = 4;
>>>>>>> forked/LAE_400_PACKAGE

    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array[] */
    private $operations;

    /** @var array */
    private $options;

<<<<<<< HEAD
=======
    /** @var boolean */
    private $isArrayFiltersUsed = false;

    /** @var boolean */
    private $isCollationUsed = false;

>>>>>>> forked/LAE_400_PACKAGE
    /**
     * Constructs a bulk write operation.
     *
     * Example array structure for all supported operation types:
     *
     *  [
     *    [ 'deleteMany' => [ $filter, $options ] ],
     *    [ 'deleteOne'  => [ $filter, $options ] ],
     *    [ 'insertOne'  => [ $document ] ],
     *    [ 'replaceOne' => [ $filter, $replacement, $options ] ],
     *    [ 'updateMany' => [ $filter, $update, $options ] ],
     *    [ 'updateOne'  => [ $filter, $update, $options ] ],
     *  ]
     *
     * Arguments correspond to the respective Operation classes; however, the
     * writeConcern option is specified for the top-level bulk write operation
     * instead of each individual operation.
     *
     * Supported options for deleteMany and deleteOne operations:
     *
     *  * collation (document): Collation specification.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * Supported options for replaceOne, updateMany, and updateOne operations:
     *
     *  * collation (document): Collation specification.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * upsert (boolean): When true, a new document is created if no document
     *    matches the query. The default is false.
     *
     * Supported options for updateMany and updateOne operations:
     *
     *  * arrayFilters (document array): A set of filters specifying to which
     *    array elements an update should apply.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.6 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * Supported options for the bulk write operation:
     *
     *  * bypassDocumentValidation (boolean): If true, allows the write to
     *    circumvent document level validation. The default is false.
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command(s)
     *    associated with this bulk write.
     *
     *    This is not supported for servers versions < 4.4.
=======
     *    For servers < 3.2, this option is ignored as document level validation
     *    is not available.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * ordered (boolean): If true, when an insert fails, return without
     *    performing the remaining writes. If false, when a write fails,
     *    continue with the remaining writes, if any. The default is true.
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
     * @param string  $databaseName   Database name
     * @param string  $collectionName Collection name
     * @param array[] $operations     List of write operations
     * @param array   $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, array $operations, array $options = [])
=======
    public function __construct($databaseName, $collectionName, array $operations, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (empty($operations)) {
            throw new InvalidArgumentException('$operations is empty');
        }

        $expectedIndex = 0;

        foreach ($operations as $i => $operation) {
            if ($i !== $expectedIndex) {
                throw new InvalidArgumentException(sprintf('$operations is not a list (unexpected index: "%s")', $i));
            }

            if (! is_array($operation)) {
                throw InvalidArgumentException::invalidType(sprintf('$operations[%d]', $i), $operation, 'array');
            }

            if (count($operation) !== 1) {
                throw new InvalidArgumentException(sprintf('Expected one element in $operation[%d], actually: %d', $i, count($operation)));
            }

            $type = key($operation);
            $args = current($operation);

            if (! isset($args[0]) && ! array_key_exists(0, $args)) {
                throw new InvalidArgumentException(sprintf('Missing first argument for $operations[%d]["%s"]', $i, $type));
            }

            if (! is_array($args[0]) && ! is_object($args[0])) {
                throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][0]', $i, $type), $args[0], 'array or object');
            }

            switch ($type) {
                case self::INSERT_ONE:
                    break;

                case self::DELETE_MANY:
                case self::DELETE_ONE:
                    if (! isset($args[1])) {
                        $args[1] = [];
                    }

                    if (! is_array($args[1])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][1]', $i, $type), $args[1], 'array');
                    }

                    $args[1]['limit'] = ($type === self::DELETE_ONE ? 1 : 0);

<<<<<<< HEAD
                    if (isset($args[1]['collation']) && ! is_array($args[1]['collation']) && ! is_object($args[1]['collation'])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][1]["collation"]', $i, $type), $args[1]['collation'], 'array or object');
=======
                    if (isset($args[1]['collation'])) {
                        $this->isCollationUsed = true;

                        if (! is_array($args[1]['collation']) && ! is_object($args[1]['collation'])) {
                            throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][1]["collation"]', $i, $type), $args[1]['collation'], 'array or object');
                        }
>>>>>>> forked/LAE_400_PACKAGE
                    }

                    $operations[$i][$type][1] = $args[1];

                    break;

                case self::REPLACE_ONE:
                    if (! isset($args[1]) && ! array_key_exists(1, $args)) {
                        throw new InvalidArgumentException(sprintf('Missing second argument for $operations[%d]["%s"]', $i, $type));
                    }

                    if (! is_array($args[1]) && ! is_object($args[1])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][1]', $i, $type), $args[1], 'array or object');
                    }

                    if (is_first_key_operator($args[1])) {
                        throw new InvalidArgumentException(sprintf('First key in $operations[%d]["%s"][1] is an update operator', $i, $type));
                    }

                    if (! isset($args[2])) {
                        $args[2] = [];
                    }

                    if (! is_array($args[2])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]', $i, $type), $args[2], 'array');
                    }

                    $args[2]['multi'] = false;
                    $args[2] += ['upsert' => false];

<<<<<<< HEAD
                    if (isset($args[2]['collation']) && ! is_array($args[2]['collation']) && ! is_object($args[2]['collation'])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["collation"]', $i, $type), $args[2]['collation'], 'array or object');
=======
                    if (isset($args[2]['collation'])) {
                        $this->isCollationUsed = true;

                        if (! is_array($args[2]['collation']) && ! is_object($args[2]['collation'])) {
                            throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["collation"]', $i, $type), $args[2]['collation'], 'array or object');
                        }
>>>>>>> forked/LAE_400_PACKAGE
                    }

                    if (! is_bool($args[2]['upsert'])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["upsert"]', $i, $type), $args[2]['upsert'], 'boolean');
                    }

                    $operations[$i][$type][2] = $args[2];

                    break;

                case self::UPDATE_MANY:
                case self::UPDATE_ONE:
                    if (! isset($args[1]) && ! array_key_exists(1, $args)) {
                        throw new InvalidArgumentException(sprintf('Missing second argument for $operations[%d]["%s"]', $i, $type));
                    }

                    if (! is_array($args[1]) && ! is_object($args[1])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][1]', $i, $type), $args[1], 'array or object');
                    }

                    if (! is_first_key_operator($args[1]) && ! is_pipeline($args[1])) {
                        throw new InvalidArgumentException(sprintf('First key in $operations[%d]["%s"][1] is neither an update operator nor a pipeline', $i, $type));
                    }

                    if (! isset($args[2])) {
                        $args[2] = [];
                    }

                    if (! is_array($args[2])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]', $i, $type), $args[2], 'array');
                    }

                    $args[2]['multi'] = ($type === self::UPDATE_MANY);
                    $args[2] += ['upsert' => false];

<<<<<<< HEAD
                    if (isset($args[2]['arrayFilters']) && ! is_array($args[2]['arrayFilters'])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["arrayFilters"]', $i, $type), $args[2]['arrayFilters'], 'array');
                    }

                    if (isset($args[2]['collation']) && ! is_array($args[2]['collation']) && ! is_object($args[2]['collation'])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["collation"]', $i, $type), $args[2]['collation'], 'array or object');
=======
                    if (isset($args[2]['arrayFilters'])) {
                        $this->isArrayFiltersUsed = true;

                        if (! is_array($args[2]['arrayFilters'])) {
                            throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["arrayFilters"]', $i, $type), $args[2]['arrayFilters'], 'array');
                        }
                    }

                    if (isset($args[2]['collation'])) {
                        $this->isCollationUsed = true;

                        if (! is_array($args[2]['collation']) && ! is_object($args[2]['collation'])) {
                            throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["collation"]', $i, $type), $args[2]['collation'], 'array or object');
                        }
>>>>>>> forked/LAE_400_PACKAGE
                    }

                    if (! is_bool($args[2]['upsert'])) {
                        throw InvalidArgumentException::invalidType(sprintf('$operations[%d]["%s"][2]["upsert"]', $i, $type), $args[2]['upsert'], 'boolean');
                    }

                    $operations[$i][$type][2] = $args[2];

                    break;

                default:
                    throw new InvalidArgumentException(sprintf('Unknown operation type "%s" in $operations[%d]', $type, $i));
            }

            $expectedIndex += 1;
        }

        $options += ['ordered' => true];

        if (isset($options['bypassDocumentValidation']) && ! is_bool($options['bypassDocumentValidation'])) {
            throw InvalidArgumentException::invalidType('"bypassDocumentValidation" option', $options['bypassDocumentValidation'], 'boolean');
        }

        if (! is_bool($options['ordered'])) {
            throw InvalidArgumentException::invalidType('"ordered" option', $options['ordered'], 'boolean');
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

        if (isset($options['bypassDocumentValidation']) && ! $options['bypassDocumentValidation']) {
            unset($options['bypassDocumentValidation']);
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
        $this->operations = $operations;
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @return BulkWriteResult
     * @throws UnsupportedException if write concern is used and unsupported
=======
     * @param Server $server
     * @return BulkWriteResult
     * @throws UnsupportedException if array filters or collation is used and unsupported
>>>>>>> forked/LAE_400_PACKAGE
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
<<<<<<< HEAD
=======
        if ($this->isArrayFiltersUsed && ! server_supports_feature($server, self::$wireVersionForArrayFilters)) {
            throw UnsupportedException::arrayFiltersNotSupported();
        }

        if ($this->isCollationUsed && ! server_supports_feature($server, self::$wireVersionForCollation)) {
            throw UnsupportedException::collationNotSupported();
        }

>>>>>>> forked/LAE_400_PACKAGE
        $inTransaction = isset($this->options['session']) && $this->options['session']->isInTransaction();
        if ($inTransaction && isset($this->options['writeConcern'])) {
            throw UnsupportedException::writeConcernNotSupportedInTransaction();
        }

<<<<<<< HEAD
        $bulk = new Bulk($this->createBulkWriteOptions());
=======
        $options = ['ordered' => $this->options['ordered']];

        if (! empty($this->options['bypassDocumentValidation']) &&
            server_supports_feature($server, self::$wireVersionForDocumentLevelValidation)
        ) {
            $options['bypassDocumentValidation'] = $this->options['bypassDocumentValidation'];
        }

        $bulk = new Bulk($options);
>>>>>>> forked/LAE_400_PACKAGE
        $insertedIds = [];

        foreach ($this->operations as $i => $operation) {
            $type = key($operation);
            $args = current($operation);

            switch ($type) {
                case self::DELETE_MANY:
                case self::DELETE_ONE:
                    $bulk->delete($args[0], $args[1]);
                    break;

                case self::INSERT_ONE:
                    $insertedIds[$i] = $bulk->insert($args[0]);
                    break;

                case self::REPLACE_ONE:
                case self::UPDATE_MANY:
                case self::UPDATE_ONE:
                    $bulk->update($args[0], $args[1], $args[2]);
            }
        }

<<<<<<< HEAD
        $writeResult = $server->executeBulkWrite($this->databaseName . '.' . $this->collectionName, $bulk, $this->createExecuteOptions());
=======
        $writeResult = $server->executeBulkWrite($this->databaseName . '.' . $this->collectionName, $bulk, $this->createOptions());
>>>>>>> forked/LAE_400_PACKAGE

        return new BulkWriteResult($writeResult, $insertedIds);
    }

    /**
<<<<<<< HEAD
     * Create options for constructing the bulk write.
     *
     * @see https://php.net/manual/en/mongodb-driver-bulkwrite.construct.php
     */
    private function createBulkWriteOptions(): array
    {
        $options = ['ordered' => $this->options['ordered']];

        foreach (['bypassDocumentValidation', 'comment'] as $option) {
            if (isset($this->options[$option])) {
                $options[$option] = $this->options[$option];
            }
        }

        if (isset($this->options['let'])) {
            $options['let'] = (object) $this->options['let'];
        }

        return $options;
    }

    /**
     * Create options for executing the bulk write.
     *
     * @see https://php.net/manual/en/mongodb-driver-server.executebulkwrite.php
     */
    private function createExecuteOptions(): array
=======
     * Create options for executing the bulk write.
     *
     * @see http://php.net/manual/en/mongodb-driver-server.executebulkwrite.php
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
