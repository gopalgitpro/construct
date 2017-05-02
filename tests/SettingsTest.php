<?php

namespace JonathanTorres\Construct\Tests;

use JonathanTorres\Construct\Settings;
use PHPUnit\Framework\TestCase;

class SettingsTest extends TestCase
{
    protected $settings;

    protected function setUp()
    {
        $this->settings = new Settings(
            'jonathantorres/logger',
            'phpunit',
            'MIT',
            'JonathanTorres\Logger',
            true,
            true,
            'some, another, keyword',
            false,
            false,
            '5.6.0',
            true,
            false,
            null
        );
    }

    public function testSettingsAreRetrieved()
    {
        $this->assertEquals('jonathantorres/logger', $this->settings->getProjectName());
        $this->assertEquals('phpunit', $this->settings->getTestingFramework());
        $this->assertEquals('MIT', $this->settings->getLicense());
        $this->assertEquals('JonathanTorres\Logger', $this->settings->getNamespace());
        $this->assertTrue($this->settings->withGitInit());
        $this->assertTrue($this->settings->withPhpcsConfiguration());
        $this->assertSame('some, another, keyword', $this->settings->getComposerKeywords());
        $this->assertFalse($this->settings->withVagrantfile());
        $this->assertFalse($this->settings->withEditorConfig());
        $this->assertSame('5.6.0', $this->settings->getPhpVersion());
        $this->assertTrue($this->settings->withEnvironmentFiles());
        $this->assertFalse($this->settings->withLgtmConfiguration());
        $this->assertFalse($this->settings->withGithubDocs());
        $this->assertNull($this->settings->getCliFramework());
    }

    public function testCanSetCliFrameworkAfterInstantiation()
    {
        $this->assertFalse($this->settings->withCliFramework());

        $this->settings->setCliFramework('zendframework/zend-console');

        $this->assertTrue($this->settings->withCliFramework());
        $this->assertEquals('zendframework/zend-console', $this->settings->getCliFramework());
    }
}
