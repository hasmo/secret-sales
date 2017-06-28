<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 27/06/2017
 * Time: 22:37
 */

namespace Hassan\SecretSales\AppBundle\Text\Consume;

class UrlBasedTextConsumerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldConsumeTextFromUrl()
    {
        $textConsumer = new UrlBasedTextConsumer('http://google.com');
        $this->assertNotEmpty($textConsumer->text());
    }

    /**
     * @test
     * @expectedException \Hassan\SecretSales\AppBundle\Text\Consume\Exception\CouldNotConsumeTextException
     */
    public function shouldThrowExceptionOnEmptyText()
    {
        $textConsumer = new UrlBasedTextConsumer('http://secretsalesnonexistentname.com');
        $this->assertNotEmpty($textConsumer->text());
    }
}
