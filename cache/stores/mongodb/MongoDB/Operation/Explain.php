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
<<<<<<< HEAD
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
=======
>>>>>>> forked/LAE_400_PACKAGE
use MongoDB\Driver\ReadPreference;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function current;
use function is_array;
use function is_string;
use function MongoDB\server_supports_feature;

/**
 * Operation for the explain command.
 *
 * @api
 * @see \MongoDB\Collection::explain()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/explain/
 */
class Explain implements Executable
{
    public const VERBOSITY_ALL_PLANS = 'allPlansExecution';
    public const VERBOSITY_EXEC_STATS = 'executionStats';
    public const VERBOSITY_QUERY = 'queryPlanner';
=======
 * @see http://docs.mongodb.org/manual/reference/command/explain/
 */
class Explain implements Executable
{
    const VERBOSITY_ALL_PLANS = 'allPlansExecution';
    const VERBOSITY_EXEC_STATS = 'executionStats';
    const VERBOSITY_QUERY = 'queryPlanner';
>>>>>>> forked/LAE_400_PACKAGE

    /** @var integer */
    private static $wireVersionForAggregate = 7;

<<<<<<< HEAD
=======
    /** @var integer */
    private static $wireVersionForDistinct = 4;

    /** @var integer */
    private static $wireVersionForFindAndModify = 4;

>>>>>>> forked/LAE_400_PACKAGE
    /** @var string */
    private $databaseName;

    /** @var Explainable */
    private $explainable;

    /** @var array */
    private $options;

    /**
     * Constructs an explain command for explainable operations.
     *
     * Supported options:
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
     *
=======
>>>>>>> forked/LAE_400_PACKAGE
     *  * readPreference (MongoDB\Driver\ReadPreference): Read preference.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
     *  * typeMap (array): Type map for BSON deserialization. This will be used
     *    used for the returned command result document.
     *
     *  * verbosity (string): The mode in which the explain command will be run.
     *
     * @param string      $databaseName Database name
     * @param Explainable $explainable  Operation to explain
     * @param array       $options      Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, Explainable $explainable, array $options = [])
=======
    public function __construct($databaseName, Explainable $explainable, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (isset($options['readPreference']) && ! $options['readPreference'] instanceof ReadPreference) {
            throw InvalidArgumentException::invalidType('"readPreference" option', $options['readPreference'], ReadPreference::class);
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['typeMap']) && ! is_array($options['typeMap'])) {
            throw InvalidArgumentException::invalidType('"typeMap" option', $options['typeMap'], 'array');
        }

        if (isset($options['verbosity']) && ! is_string($options['verbosity'])) {
            throw InvalidArgumentException::invalidType('"verbosity" option', $options['verbosity'], 'string');
        }

        $this->databaseName = $databaseName;
        $this->explainable = $explainable;
        $this->options = $options;
    }

<<<<<<< HEAD
    /**
     * Execute the operation.
     *
     * @see Executable::execute()
     * @return array|object
     * @throws UnsupportedException if the server does not support explaining the operation
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
=======
    public function execute(Server $server)
    {
        if ($this->explainable instanceof Distinct && ! server_supports_feature($server, self::$wireVersionForDistinct)) {
            throw UnsupportedException::explainNotSupported();
        }

        if ($this->isFindAndModify($this->explainable) && ! server_supports_feature($server, self::$wireVersionForFindAndModify)) {
            throw UnsupportedException::explainNotSupported();
        }

>>>>>>> forked/LAE_400_PACKAGE
        if ($this->explainable instanceof Aggregate && ! server_supports_feature($server, self::$wireVersionForAggregate)) {
            throw UnsupportedException::explainNotSupported();
        }

<<<<<<< HEAD
        $cursor = $server->executeCommand($this->databaseName, $this->createCommand($server), $this->createOptions());
=======
        $cmd = ['explain' => $this->explainable->getCommandDocument($server)];

        if (isset($this->options['verbosity'])) {
            $cmd['verbosity'] = $this->options['verbosity'];
        }

        $cursor = $server->executeCommand($this->databaseName, new Command($cmd), $this->createOptions());
>>>>>>> forked/LAE_400_PACKAGE

        if (isset($this->options['typeMap'])) {
            $cursor->setTypeMap($this->options['typeMap']);
        }

        return current($cursor->toArray());
    }

    /**
<<<<<<< HEAD
     * Create the explain command.
     */
    private function createCommand(Server $server): Command
    {
        $cmd = ['explain' => $this->explainable->getCommandDocument($server)];

        foreach (['comment', 'verbosity'] as $option) {
            if (isset($this->options[$option])) {
                $cmd[$option] = $this->options[$option];
            }
        }

        return new Command($cmd);
    }

    /**
     * Create options for executing the command.
     *
     * @see https://php.net/manual/en/mongodb-driver-server.executecommand.php
     */
    private function createOptions(): array
=======
     * Create options for executing the command.
     *
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

<<<<<<< HEAD
    private function isFindAndModify(Explainable $explainable): bool
=======
    private function isFindAndModify($explainable)
>>>>>>> forked/LAE_400_PACKAGE
    {
        if ($explainable instanceof FindAndModify || $explainable instanceof FindOneAndDelete || $explainable instanceof FindOneAndReplace || $explainable instanceof FindOneAndUpdate) {
            return true;
        }

        return false;
    }
}
