<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 27/06/2017
 * Time: 22:50
 */

namespace Hassan\SecretSales\AppBundle\Text\Display;

use Hassan\SecretSales\AppBundle\Text\Consume\TextFileConsumer;
use Hassan\SecretSales\AppBundle\Text\Provider\WordCountDisplayingTextProvider;
use Mockery;

class WordCountDisplayingTextProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var WordCountDisplayingTextProvider
     */
    private $textPresenter;

    /**
     * @var TextFileConsumer|Mockery\MockInterface
     */
    private $textFileConsumer;

    public function setUp()
    {
        $this->textFileConsumer = Mockery::mock('Hassan\SecretSales\AppBundle\Text\Consume\TextFileConsumer');
        $this->textPresenter = new WordCountDisplayingTextProvider(
            $this->textFileConsumer
        );
    }

    /**
     * @test
     */
    public function shouldDisplayText()
    {
        $text = "foo foo";

        $this->textFileConsumer
            ->shouldReceive('text')
            ->once()
            ->andReturn($text);

        $frequentWords = $this->textPresenter->text();

        $this->assertEquals("foo,2\n", $frequentWords);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionOnNoText()
    {
        $this->textFileConsumer
            ->shouldReceive('text')
            ->once()
            ->andThrow('\Hassan\SecretSales\AppBundle\Text\Consume\Exception\CouldNotConsumeTextException');

        $this->textPresenter->text();
    }
}
