<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 21/06/2017
 * Time: 19:08
 */

namespace Hassan\SecretSales\AppBundle\Text\Consume;

interface TextFileConsumer
{
    /**
     * @return string
     */
    public function text();
}
