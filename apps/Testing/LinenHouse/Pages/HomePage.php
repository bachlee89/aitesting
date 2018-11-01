<?php
/**
 * @author Bach Lee <bach@balanceinternet.com.au>
 * @copyright  (c) 2018 Balance Internet (https://www.balanceinternet.com.au)
 */

namespace Testing\LinenHouse\Pages;

use Testing\Testing;
use Applitools\RectangleSize;
use Facebook\WebDriver\Remote\RemoteWebDriver;

/**
 * Class HomePage
 * @package Testing\LinenHouse\Pages
 */
class HomePage extends Testing
{
    /**
     * HomePage constructor.
     */
    public function __construct()
    {
        $this->initTest();
        parent::__construct();
    }

    /**
     * Init test variables
     */
    private function initTest()
    {
        $this->setAppName('LinenHouse');
        $this->setTestName('LinenHouse Homepage v5');
        $this->setBatchInfo('LinenHouse Homepage v5 Batch');
        $this->setWebUrl('https://www.linenhouse.com/');
    }

    /**
     * @inheritdoc
     */
    public function run(): void
    {
        $viewportSizeLandscape = new RectangleSize(
            1024,
            768);
        $viewportSizePortrait = new RectangleSize(
            500,
            900);
//        $innerDriver = $this->getInnerDriver('Firefox', '63.0');
//        $innerDriver = $this->getInnerDriver('Firefox', '53.0');
//        $innerDriver = $this->getInnerDriver('Firefox', '43.0');
//        $innerDriver = $this->getInnerDriver('Firefox', '33.0');


//        $innerDriver = $this->getInnerDriver('Chrome', '63.0');
//        $innerDriver = $this->getInnerDriver('Chrome', '53.0');
//        $innerDriver = $this->getInnerDriver('Chrome', '43.0');

//        $innerDriver = $this->getInnerDriver('Edge', '17.0');
        $drivers = [
            ['Chrome' => '63.0'],
            ['Chrome' => '53.0'],
            ['Chrome' => '43.0'],
            ['Firefox' => '63.0'],
            ['Firefox' => '53.0'],
            ['Firefox' => '43.0'],
            ['Firefox' => '33.0'],
            ['Edge' => '17.0'],
            ['Edge' => '16.0'],
        ];
        foreach ($drivers as $driver) {
            foreach ($driver as $browser => $version) {
                $innerDriver = $this->getInnerDriver($browser, $version);
                $innerDriver->manage()->window()->maximize();
                $this->test($innerDriver, $viewportSizeLandscape, 'Home Test');
                $this->test($innerDriver, $viewportSizePortrait, 'Home Test');
                $innerDriver->quit();
            }
        }
    }

    /**
     * @param $browser
     * @param $version
     * @return RemoteWebDriver
     */
    private function getInnerDriver($browser, $version)
    {
        $capabilities = [
            "browser" => $browser,
            "browser_version" => $version,
            "os" => "Windows",
            "os_version" => "10"
        ];
        return RemoteWebDriver::create('https://bach12:jVQQwzQxhNj5Yqs78p4A@hub-cloud.browserstack.com/wd/hub',
            $capabilities);
    }

    /**
     * @param $innerDriver
     * @param $viewportSize
     * @param $pointName
     * @throws \Applitools\Exceptions\EyesException
     * @throws \Applitools\Exceptions\NewTestException
     * @throws \Applitools\Exceptions\TestFailedException
     */
    private function test($innerDriver, $viewportSize, $pointName)
    {
        $eyes = $this->getEyes();
        // Start the test and set the browser's viewport size
        $driver = $eyes->open($innerDriver, $this->getAppName(), $this->getAppName(), $viewportSize);
        try {
            $driver->get($this->getWebUrl());
            $eyes->checkWindow($pointName);
            $result = $eyes->close(false);
            $this->handleResult($result);
        } finally {
            // If the test was aborted before eyes->close was called, ends the test as aborted.
            $eyes->abortIfNotClosed();
        }
    }

    /**
     * @param $result
     */
    private function handleResult($result)
    {
        $url = $result->getUrl();
        $totalSteps = $result->getSteps();
        if ($result->isNew()) {
            $resultStr = "New Baseline Created: " . $totalSteps . " steps";
        } else {
            if ($result->isPassed()) {
                $resultStr = "All steps passed:     " . $totalSteps . " steps";
            } else {
                $resultStr = "Test Failed     :     " . $totalSteps . " steps";
                $resultStr .= " matches=" . $result->getMatches();      //  matched the baseline
                $resultStr .= " missing=" . $result->getMissing();       // missing in the test
                $resultStr .= " mismatches=" . $result->getMismatches(); // did not match the baseline
            }
        }
        $resultStr .= "\n" . "results at " . $url . "\n";
        echo $resultStr;
    }
}