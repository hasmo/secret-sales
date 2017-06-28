<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 26/06/2017
 * Time: 01:21
 */

namespace Hassan\SecretSales\AppBundle\Text\Consume;

use Hassan\SecretSales\AppBundle\Text\Consume\Exception\CouldNotConsumeTextException;

class UrlBasedTextConsumer implements TextFileConsumer
{
    /**
     * @var string
     */
    private $url;

    /**
     * UrlBasedTextConsumer constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = trim($url);
    }

    /**
     * @return string
     * @throws CouldNotConsumeTextException
     */
    public function text()
    {
        $text = @file_get_contents($this->url);

        if ($text === false) {
            throw new CouldNotConsumeTextException("There was a problem consuming text from url " . $this->url);
        }

        return $text;
    }
}
