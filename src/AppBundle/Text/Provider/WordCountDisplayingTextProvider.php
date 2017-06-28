<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 27/06/2017
 * Time: 22:05
 */

namespace Hassan\SecretSales\AppBundle\Text\Provider;

use Hassan\SecretSales\AppBundle\Text\Consume\Exception\CouldNotConsumeTextException;
use Hassan\SecretSales\AppBundle\Text\Consume\TextFileConsumer;

class WordCountDisplayingTextProvider implements TextProvider
{
    /**
     * @var TextFileConsumer
     */
    private $textFileConsumer;

    /**
     * FrequentWordsProcessorUsingTextPresenter constructor.
     * @param TextFileConsumer $textFileConsumer
     */
    public function __construct(TextFileConsumer $textFileConsumer)
    {
        $this->textFileConsumer = $textFileConsumer;
    }

    /**
     * Returns most frequent words in format "word,count"
     *
     * @return string
     */
    public function text()
    {
        try {
            $text = $this->frequentWords($this->textFileConsumer->text());

            $frequentWords = "";
            foreach($text as $word => $count) {
                $frequentWords .= $word . "," . $count . "\n";
            }

            return $frequentWords;

        } catch (CouldNotConsumeTextException $e) {
            return $e->getMessage();
        }
    }

    /**
     * N.B: Borrowed the logic in this function from stackoverflow
     *
     * @param $text
     * @return array
     */
    private function frequentWords($text)
    {
        $text = str_replace("\r\n", " ", $text);
        $text = preg_replace('/[^a-zA-Z\s]/', '', $text);
        $text = preg_replace('/(\s){2,}/', ' ', $text);
        $text = strtolower($text);
        $text = explode(" ", $text);

        $out = array_count_values($text);
        arsort($out);

        return array_slice($out, 0, 100);
    }
}
