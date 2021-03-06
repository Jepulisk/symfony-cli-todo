<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Controller\TodoController;
use Symfony\Component\Console\Question\Question;

class TodoNewCommand extends Command
{
    protected static $defaultName = "todo:new";

    protected function configure()
    {
        $this
            ->setDescription("Creates a new todo.")
            ->setHelp("Creates a new todo.")
        ;
    }

    private $todoController;

    public function __construct(TodoController $todoController)
    {
        $this->todoController = $todoController;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper("question");
        $question = new Question("Enter todo description: ");

        $description = $helper->ask($input, $output, $question);

        if ($description)
        {
            $this->todoController->new($description);

            $output->writeln("Created new todo!");
            return Command::SUCCESS;
        }

        $output->writeln("Please provide todo description.");
        return Command::FAILURE;
    }
}
