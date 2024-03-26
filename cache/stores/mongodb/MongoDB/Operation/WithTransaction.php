<?php

namespace MongoDB\Operation;

use Exception;
use MongoDB\Driver\Exception\RuntimeException;
use MongoDB\Driver\Session;
use Throwable;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function call_user_func;
use function time;

/**
 * @internal
 */
class WithTransaction
{
    /** @var callable */
    private $callback;

    /** @var array */
    private $transactionOptions;

    /**
     * @see Session::startTransaction for supported transaction options
     *
     * @param callable $callback           A callback that will be invoked within the transaction
     * @param array    $transactionOptions Additional options that are passed to Session::startTransaction
     */
    public function __construct(callable $callback, array $transactionOptions = [])
    {
        $this->callback = $callback;
        $this->transactionOptions = $transactionOptions;
    }

    /**
     * Execute the operation in the given session
     *
     * This helper takes care of retrying the commit operation or the entire
     * transaction if an error occurs.
     *
     * If the commit fails because of an UnknownTransactionCommitResult error, the
     * commit is retried without re-invoking the callback.
     * If the commit fails because of a TransientTransactionError, the entire
     * transaction will be retried. In this case, the callback will be invoked
     * again. It is important that the logic inside the callback is idempotent.
     *
     * In case of failures, the commit or transaction are retried until 120 seconds
     * from the initial call have elapsed. After that, no retries will happen and
     * the helper will throw the last exception received from the driver.
     *
     * @see Client::startSession
     *
     * @param Session $session A session object as retrieved by Client::startSession
<<<<<<< HEAD
     * @throws RuntimeException for driver errors while committing the transaction
     * @throws Exception for any other errors, including those thrown in the callback
     */
    public function execute(Session $session): void
=======
     * @return void
     * @throws RuntimeException for driver errors while committing the transaction
     * @throws Exception for any other errors, including those thrown in the callback
     */
    public function execute(Session $session)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $startTime = time();

        while (true) {
            $session->startTransaction($this->transactionOptions);

            try {
                call_user_func($this->callback, $session);
            } catch (Throwable $e) {
                if ($session->isInTransaction()) {
                    $session->abortTransaction();
                }

<<<<<<< HEAD
                if (
                    $e instanceof RuntimeException &&
=======
                if ($e instanceof RuntimeException &&
>>>>>>> forked/LAE_400_PACKAGE
                    $e->hasErrorLabel('TransientTransactionError') &&
                    ! $this->isTransactionTimeLimitExceeded($startTime)
                ) {
                    continue;
                }

                throw $e;
            }

            if (! $session->isInTransaction()) {
                // Assume callback intentionally ended the transaction
                return;
            }

            while (true) {
                try {
                    $session->commitTransaction();
                } catch (RuntimeException $e) {
<<<<<<< HEAD
                    if (
                        $e->getCode() !== 50 /* MaxTimeMSExpired */ &&
=======
                    if ($e->getCode() !== 50 /* MaxTimeMSExpired */ &&
>>>>>>> forked/LAE_400_PACKAGE
                        $e->hasErrorLabel('UnknownTransactionCommitResult') &&
                        ! $this->isTransactionTimeLimitExceeded($startTime)
                    ) {
                        // Retry committing the transaction
                        continue;
                    }

<<<<<<< HEAD
                    if (
                        $e->hasErrorLabel('TransientTransactionError') &&
=======
                    if ($e->hasErrorLabel('TransientTransactionError') &&
>>>>>>> forked/LAE_400_PACKAGE
                        ! $this->isTransactionTimeLimitExceeded($startTime)
                    ) {
                        // Restart the transaction, invoking the callback again
                        continue 2;
                    }

                    throw $e;
                }

                // Commit was successful
                break;
            }

            // Transaction was successful
            break;
        }
    }

    /**
     * Returns whether the time limit for retrying transactions in the convenient transaction API has passed
     *
     * @param int $startTime The time the transaction was started
<<<<<<< HEAD
     */
    private function isTransactionTimeLimitExceeded(int $startTime): bool
=======
     * @return bool
     */
    private function isTransactionTimeLimitExceeded($startTime)
>>>>>>> forked/LAE_400_PACKAGE
    {
        return time() - $startTime >= 120;
    }
}
