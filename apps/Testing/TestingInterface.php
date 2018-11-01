<?php
/**
 * @author Bach Lee <bach@balanceinternet.com.au>
 * @copyright  (c) 2018 Balance Internet (https://www.balanceinternet.com.au)
 */

namespace Testing;

interface TestingInterface
{
    /**
     * Get application name
     * @return string
     */
    public function getAppName(): string;

    /**
     * Set application name
     * @param string $appName
     * @return $this
     */
    public function setAppName(string $appName);

    /**
     * Get test name
     * @return string
     */
    public function getTestName(): string;

    /**
     * Set the value of testName so that it has a unique value on your Eyes system
     * @param string $testName
     * @return $this
     */
    public function setTestName(string $testName);

    /**
     * Get run as batch
     * @return bool
     */
    public function getRunAsBatch(): bool;

    /**
     * Set the value of runAsBatch to true so that the tests run as a single batch
     * @param bool $runAsBatch
     * @return $this
     */
    public function setRunAsBatch(bool $runAsBatch);

    /**
     * Get change value test
     * @return bool
     */
    public function getChangeValueTest(): bool;

    /**
     * Set the value of changeTest to true to introduce changes that Eyes will detect as mismatches
     * @param bool $changeValueTest
     * @return $this
     */
    public function setChangeValueTest(bool $changeValueTest);

    /**
     * Get Website url to test
     * @return string
     */
    public function getWebUrl(): string;

    /**
     * Set Website url to test
     * @param string $webUrl
     * @return $this
     */
    public function setWebUrl(string $webUrl);

    /**
     * @return string
     */
    public function getBatchInfo(): string;

    /**
     * @param string $batchInfo
     * @return mixed
     */
    public function setBatchInfo(string $batchInfo);
}