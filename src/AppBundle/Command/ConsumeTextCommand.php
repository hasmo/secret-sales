<?php
/**
 * Created by PhpStorm.
 * User: hassan
 * Date: 21/06/2017
 * Time: 19:06
 */

namespace Hassan\SecretSales\AppBundle\Command;

use Hassan\SecretSales\AppBundle\Text\Provider\TextProvider;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ConsumeTextCommand
 * @package Hassan\SecretSales\AppBundle\Command
 */
class ConsumeTextCommand extends ContainerAwareCommand
{
    /**
     * @var TextProvider
     */
    private $textProvider;

    /**
     * ConsumeTextCommand constructor.
     * @param TextProvider $textProvider
     */
    public function __construct(TextProvider $textProvider)
    {
        $this->textProvider = $textProvider;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('secret-sales:consume-text')
            ->setDescription('Consumes text and outputs the 100 most frequent words')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $frequentWords = $this->textProvider->text();
        $output->writeln($frequentWords);
    }
}
