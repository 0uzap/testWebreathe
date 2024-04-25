<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\DBAL\Driver\Connection;
use Doctrine\DBAL\Connection as DBALConnection;


#[AsCommand(
    name: 'app:ajout-mesures',
    description: 'commande servant à ajouter des valeurs dans la table mesures',
)]
class AjoutMesuresCommand extends Command
{
    private $connection;

    public function __construct(DBALConnection $connection)
    {
        $this->connection = $connection;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sql = "INSERT INTO mesures (module_id, donnees_numeriques_id, valeur, date, etat_module)
            SELECT 
                m.id AS module_id,
                dn.id AS donnees_numeriques_id,
                ROUND(RAND() * 100) AS valeur,
                NOW() AS date,
                IF(ROUND(RAND() * 4) = 0, 'cassé', 'actif') AS etat_module
            FROM
                (SELECT id FROM module ORDER BY id) m
                CROSS JOIN (SELECT id FROM donnees_numeriques ORDER BY id) dn
            WHERE
                m.id = dn.id
            ORDER BY m.id";

        $this->connection->executeQuery($sql);

        $output->writeln('Valeurs ajoutées avec succès.');

        return Command::SUCCESS;
    }
}