<?php

namespace AppBundle\Command;

use AppBundle\Entity\History;
use AppBundle\Entity\Snowboarder;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
require_once('sparqllib.php');

class HistoryCommand extends Command
{
    private $em;
    private $sparqlService;

    public function __construct(EntityManager $entityManager, $sparqlService)
    {
        parent::__construct();
        $this->em = $entityManager;
        $this->sparqlService = $sparqlService;
    }

    protected function configure()
    {
        $this
            ->setName('app:update-histories')
            ->setDescription('This command update histories data');
    }

    /**
     * update histories data
     *
     * 1) Remove all histories
     * 2) Make sparQL query
     * 3) Insert histories data
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // 1)
        $histories = $this->em->getRepository('AppBundle:History')->findAll();
        foreach ($histories as $history) {
            $this->em->remove($history);
        }

        // 2)
        $results = $this->sparqlService->makeQuery($this->getAllHistoriesQuery());

        // 3)
        while ($row = sparql_fetch_array($results)) {
            $history = new History();
            $history->setTitle($row['title']);
            $history->setDescription($row['definition']);

            $this->em->persist($history);
        }

        $this->em->flush();
    }

    /**
     *
     * @return string
     */
    private function getAllHistoriesQuery() {
        return "
            SELECT ?title ?definition
            WHERE {
                ?def dct:subject dbc:Snowboarding .
                ?def rdfs:label ?title .
                ?def dbo:abstract ?definition .

                FILTER (lang(?title) = 'en') .
                FILTER (lang(?definition) = 'en') .
            }";
    }
}