<?php

namespace AppBundle\Service;

/**
 * Created by PhpStorm.
 * User: hugopiso
 * Date: 09/11/2016
 * Time: 10:00
 */
class SparqlService {

    public function makeQuery($query) {

        $db = sparql_connect('http://dbpedia.org/sparql');

        return sparql_query($query);
    }
}