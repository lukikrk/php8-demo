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

    private string $projectDir;

    private UserRepository $userRepository;

    private BMICalculator $bmiCalculator;

    private BMIStatusResolver $bmiStatusResolver;

    public function __construct(
        string $projectDir,
        UserRepository $userRepository,
        BMICalculator $bmiCalculator,
        BMIStatusResolver $bmiStatusResolver,
        string $name = null
    ) {

        $this->projectDir = $projectDir;
        $this->userRepository = $userRepository;
        $this->bmiCalculator = $bmiCalculator;
        $this->bmiStatusResolver = $bmiStatusResolver;

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
                $bmi = $this->bmiCalculator->calculate((float) $user->getWeight(), (float)$user->getHeight()),
                $this->bmiStatusResolver->resolve($bmi)
            ]);
        }

        fclose($csv);

        $end = microtime(true);

        $output->writeln("Operation took " . ($end - $start) . " seconds");

        return 0;
    }
}