<?php

namespace AppBundle\Service;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Created by PhpStorm.
 * User: hugopiso
 * Date: 09/11/2016
 * Time: 10:00
 */
class SparqlService {

    public function makeQuery($query) {

        try {
            $db = sparql_connect('http://dbpedia.org/sparql');
        } catch(Exception $e) {
            throw new Exception('Connexion problem');
        }

        return sparql_query($query);
    }
}