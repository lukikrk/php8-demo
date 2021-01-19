<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Infrastructure\Repository\UserRepository;
use App\Infrastructure\Service\BMICalculator;
use App\Infrastructure\Service\BMIStatusResolver;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateBMIReportCommand extends Command
{
    protected static $defaultName = 'app:bmi:report';

    public function __construct(
        private string $projectDir,
        private UserRepository $userRepository,
        private BMICalculator $bmiCalculator,
        private BMIStatusResolver $bmiStatusResolver,
        string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $start = microtime(true);

        $users = $this->userRepository->findAll();

        $csv = fopen(
            $this->projectDir . '/private/' . date('Y-m-d_H:i:s') . '_bmi_report.csv',
            'w'
        );

        foreach ($users as $user) {
            fputcsv($csv, [
                $user->getFirstName(),
                $user->getLastName(),
                $user->getWeight(),
                $user->getHeight(),
                $bmi = $this->bmiCalculator->calculate($user->getWeight(), $user->getHeight()),
                $this->bmiStatusResolver->resolve($bmi)
            ]);
        }

        fclose($csv);

        $end = microtime(true);

        $output->writeln("Operation took " . $end - $start . " seconds");

        return 0;
    }
}