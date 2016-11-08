<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SnowboarderCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:update-snowboarders');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        require_once('sparqllib.php');
        $db = sparql_connect('http://dbpedia.org/sparql');
        $query = "SELECT ?film
        WHERE { ?film <http://purl.org/dc/terms/subject> <http://dbpedia.org/resource/Category:French_films> }";

        $result = sparql_query($query);
        $fields = sparql_field_array($result);
        while($row = sparql_fetch_array($result))
        {
            foreach($fields as $field)
            {
                dump($row[$field]);
            }
        }

    }
}