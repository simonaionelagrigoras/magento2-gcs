<?php
namespace cAc\Gcs\Console\Command;

use Magento\Config\Model\Config\Factory;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigListCommand extends \Symfony\Component\Console\Command\Command
{
    private $configFactory;

    private $state;

    public function __construct(
        \Magento\Framework\App\State $state,
        Factory $configFactory
    ) {
        $this->state = $state;
        $this->configFactory = $configFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('gcs:config:list')
            ->setDescription('Lists whatever credentials for GCS you have provided for Magento.');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->state->setAreaCode('adminhtml');
        $config = $this->configFactory->create();
        $output->writeln('Here are your Google Cloud credentials:');
        $output->writeln('');
        $output->writeln(sprintf('JSON Key:     %s', $config->getConfigDataValue('cac_gcs/general/access_key')));
//         $output->writeln(sprintf('Secret Access Key: %s', $config->getConfigDataValue('cac_gcs/general/secret_key')));
        $output->writeln(sprintf('Bucket:            %s', $config->getConfigDataValue('cac_gcs/general/bucket')));
        $output->writeln(sprintf('Region:            %s', $config->getConfigDataValue('cac_gcs/general/region')));
    }
}
