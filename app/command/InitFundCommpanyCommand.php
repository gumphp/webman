<?php

namespace app\command;

use app\model\FundCompany;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class InitFundCommpanyCommand extends Command
{
    protected static $defaultName = 'init:fund-company';
    protected static $defaultDescription = '初始化基金公司数据';

    /**
     * @return void
     */
    protected function configure()
    {
//        $this->addArgument('name', InputArgument::OPTIONAL, 'Name description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = base_path() . '/database/data/fund_companies.json';
        $companies = json_decode(file_get_contents($file), true);
        foreach ($companies as $company) {

            FundCompany::query()->updateOrCreate([
                'name' => $company['name'],
            ], [
                'name' => $company['name'],
                'short_name' => $company['name'],
            ]);
        }
        $output->writeln('done');
        return self::SUCCESS;
    }

}
