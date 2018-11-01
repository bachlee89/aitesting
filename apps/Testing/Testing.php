<?php
/**
 * @author Bach Lee <bach@balanceinternet.com.au>
 * @copyright  (c) 2018 Balance Internet (https://www.balanceinternet.com.au)
 */

namespace Testing;

use Applitools\Selenium\Eyes;
use Applitools\BatchInfo;

abstract class Testing implements TestingInterface
{
    /**
     * The application name
     * @var string
     */
    private $appName;
    /**
     * The test name
     * @var string
     */
    private $testName;
    /**
     * The value of runAsBatch to true so that the tests run as a single batch
     * @var bool
     */
    private $runAsBatch = true;
    /**
     * The value of changeTest to true to introduce changes that Eyes will detect as mismatches
     * @var bool
     */
    private $changeTest = true;
    /**
     * The Url to test
     * @var string
     */
    private $webUrl;
    /**
     * @var
     */
    private $batchInfo;
    /**
     * @var Eyes
     */
    private $eyes;

    public function __construct()
    {
        $this->setupEyes();
    }

    /**
     * @param null $serverURL
     * @return Eyes
     */
    private function setupEyes($serverURL = null): Eyes
    {
        if ($serverURL === null) {
            $serverURL = 'https://eyesapi.applitools.com';
        }
        $eyes = new Eyes($serverURL);
        $apiKey = '97xe5HRwjtsOoqAhsDDeVN9uEHmXYMqcexbD7zagSESE110';
        $eyes->setApiKey($apiKey);
        if ($this->runAsBatch) {
            $batchInfo = new BatchInfo($this->getBatchInfo());
            $eyes->setBatch($batchInfo);
        }
        //eliminate artifacts caused by a blinking cursor - on by default in latest SDK
        $eyes->getDefaultMatchSettings()->setIgnoreCaret(true);
        $this->eyes = $eyes;
        return $this->eyes;
    }

    /**
     * @return Eyes
     */
    public function getEyes()
    {
        return $this->eyes;
    }

    /**
     * Run AI testing check points
     * @return mixed
     */
    abstract public function run(): void;

    /**
     * @inheritdoc
     */
    public function getAppName(): string
    {
        return $this->appName;
    }

    /**
     * @inheritdoc
     */
    public function setAppName(string $appName)
    {
        $this->appName = $appName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTestName(): string
    {
        return $this->testName;
    }

    /**
     * @inheritdoc
     */
    public function setTestName(string $testName)
    {
        $this->testName = $testName;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getRunAsBatch(): bool
    {
        return $this->runAsBatch;
    }

    /**
     * @inheritdoc
     */
    public function setRunAsBatch(bool $runAsBatch)
    {
        $this->runAsBatch = $runAsBatch;
        return $this;
    }

    /**
     * Get change value test
     * @return bool
     */
    public function getChangeValueTest(): bool
    {
        return $this->changeTest;
    }

    /**
     * @inheritdoc
     */
    public function setChangeValueTest(bool $changeValueTest)
    {
        $this->changeTest = $changeValueTest;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getWebUrl(): string
    {
        return $this->webUrl;
    }

    /**
     * @inheritdoc
     */
    public function setWebUrl(string $webUrl)
    {
        $this->webUrl = $webUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getBatchInfo(): string
    {
        return $this->batchInfo;
    }

    /**
     * @param string $batchInfo
     * @return mixed
     */
    public function setBatchInfo(string $batchInfo)
    {
        $this->batchInfo = $batchInfo;
        return $this;
    }
}