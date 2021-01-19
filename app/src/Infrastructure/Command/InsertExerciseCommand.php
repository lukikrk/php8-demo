<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Domain\Entity\Exercise;
use App\Domain\ValueObject\Exercise\ExerciseName;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertExerciseCommand extends Command
{
    protected static $defaultName = 'app:insert:exercise';

    public function __construct(private EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exercise = new Exercise(
            Uuid::uuid4(),
            new ExerciseName('Test exercise'),
            'Description',
            expertOpinion: 'Opinion'
        );

        $this->em->persist($exercise);
        $this->em->flush();

        $output->writeln('Exercise saved.');

        return 0;
    }
}
