<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Domain\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertUsersCommand extends Command
{
    protected static $defaultName = 'app:insert:users';

    public function __construct(private EntityManagerInterface $em, string $name = null)
    {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        for ($i = 0; $i < 100000; $i++) {
            $user = new User(
                Uuid::uuid4(),
                'John',
                'Doe ' . ($i + 1),
                rand(150, 210),
                rand(50, 200)
            );

            $this->em->persist($user);
        }

        $this->em->flush();

        $output->writeln('Users saved.');

        return 0;
    }
}
