<?php

namespace AppBundle\Command;

use AppBundle\Entity\Snowboarder;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
require_once('sparqllib.php');

class SnowboarderCommand extends Command
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
            ->setName('app:update-snowboarders')
            ->setDescription('This command update snowboarders data');
    }

    /**
     * update snowboarders data
     *
     * 1) Prepare to remove all snowboarders
     * 2) Make sparQL query and get all snowboarders
     * 3) Prepare to insert snowboarders data
     * 4) Execute query
     * 5) Count all data inserted
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // 1)
        $output->writeln('1) Prepare to remove all snowboarders');
        $snowboarders = $this->em->getRepository('AppBundle:Snowboarder')->findAll();
        foreach ($snowboarders as $snowboarder) {
            $this->em->remove($snowboarder);
        }

        // 2)
        $output->writeln('2) Make sparQL query and get all snowboarders');
        $results = $this->sparqlService->makeQuery($this->getAllSnowBoardersQuery());

        // 3)
        $output->writeln('3) Prepare to insert snowboarders data');
        while ($row = sparql_fetch_array($results)) {
            $snowboarder = new Snowboarder();
            $snowboarder->setDescription($row['description']);
            $snowboarder->setName($row['name']);
            $snowboarder->setWikiId($row['wikiID']);

            if (isset($row['thumbnail'])) {
                $snowboarder->setThumbnail($row['thumbnail']);
            }

            if (isset($row['birthDate'])) {

                $format = 'Y-m-d';
                $birthDate = \DateTime::createFromFormat($format, $row['birthDate']);

                if ($birthDate) {
                    $snowboarder->setBirthDate($birthDate);
                }
            }

            $this->em->persist($snowboarder);
        }

        // 4)
        $output->writeln('4) Execute query');
        $this->em->flush();

        // 5)
        $nbSnowboarders = $this->sparqlService->makeQuery($this->getCountAllSnowBoardersQuery());
        while ($row = sparql_fetch_array($nbSnowboarders)) {
            $output->writeln('5) ' . $row['nbSnowboarder'] . ' snowboarders added');
        }

    }

    /**
     * FILTER to get ride of all other languages
     * OPTIONAL to get datas even if not provided (several OPTIONAL to make an "OR")
     *
     * @return string
     */
    private function getAllSnowBoardersQuery() {
        return "
            SELECT ?description, ?name, ?thumbnail, ?wikiID, ?birthDate
            WHERE {
                ?person dct:subject <http://dbpedia.org/resource/Category:American_snowboarders> .
                ?person dbo:abstract ?description .
                ?person rdfs:label ?name .
                ?person dbo:wikiPageID ?wikiID .

            OPTIONAL { ?person dbo:thumbnail ?thumbnail }
            OPTIONAL { ?person dbp:birthDate ?birthDate }

            FILTER (lang(?description) = 'en')
            FILTER (lang(?name) = 'en')

            }";
    }

    /**
     * Count all snowboarders
     *
     * @return string
     */
    private function getCountAllSnowBoardersQuery() {
        return "
            SELECT (COUNT(DISTINCT ?person) AS ?nbSnowboarder)
            WHERE {
                ?person dct:subject <http://dbpedia.org/resource/Category:American_snowboarders> .
            }";
    }

}