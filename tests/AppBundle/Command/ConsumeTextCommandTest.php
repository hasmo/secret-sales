<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 28/06/2017
 * Time: 19:41
 */

namespace Hassan\SecretSales\AppBundle\Command;

use Hassan\SecretSales\AppBundle\Text\Consume\UrlBasedTextConsumer;
use Hassan\SecretSales\AppBundle\Text\Provider\WordCountDisplayingTextProvider;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ConsumeTextCommandTest extends KernelTestCase
{
    /**
     * @test
     */
    public function shouldExecute()
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $textFileConsumer = new UrlBasedTextConsumer(
            'https://s3-eu-west-1.amazonaws.com/secretsales-dev-test/interview/flatland.txt'
        );
        $textProvider = new WordCountDisplayingTextProvider($textFileConsumer);

        $application->add(new ConsumeTextCommand($textProvider));

        $command = $application->find('secret-sales:consume-text');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('the,1761', $output);
    }
}
