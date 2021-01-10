<?php
namespace Wcs\EmptyCommand\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Saaideveloper\CsvClass\CsvImporter;
//use \Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Sayhello extends Command
{
    protected $_dir;


   /**
     * Sayhello constructor.
     *
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\App\ResourceConnection $resourceConnection
     * @param string|null $name
     */
    public function __construct(
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\ResourceConnection $resourceConnection,
        \Magento\Framework\Filesystem\DirectoryList $dir,
        string $name = null
    ) {
        $this->_filesystem         = $filesystem;
        $this->_resourceConnection = $resourceConnection;
        $this->_mediaDirectory     = $this->_filesystem->getDirectoryRead( DirectoryList::MEDIA );
        $this->_imageDir           = $this->_mediaDirectory->getAbsolutePath() . 'catalog' . DIRECTORY_SEPARATOR . 'product';
        $this->_coreRead           = $this->_resourceConnection->getConnection( 'core_read' );
        $this->_dir = $dir;
        parent::__construct( $name );
    }

   protected function configure()
   {
       $this->setName('Wcs:sayhello');
       $this->setDescription('Demo command line');
       
       parent::configure();
   }
   protected function execute(InputInterface $input, OutputInterface $output)
   {
       try {
        $CSV='/Applications/MAMP/htdocs/ReactiveParts_M2/vendor/saaideveloper/csv-class/Data/m1_export_reactiveparts.csv';
        $importer = new CsvImporter($CSV,',',true);
        //$progress = new ProgressBar( $output, 4 );
       } catch (\Throwable $th) {
           //throw $th;
           $output->writeln($this->_dir->getRoot());
           $output->writeln($this->_dir->getPath('var'));
           $output->writeln("DD");
       }
       $output->writeln("Hello World");
   }
}