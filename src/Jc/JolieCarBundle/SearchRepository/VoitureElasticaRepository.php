<?php
/**
 * Created by PhpStorm.
 * User: Toure
 * Date: 07/02/15
 * Time: 22:03
 */

namespace Jc\JolieCarBundle\SearchRepository;


use Elastica\Query;
use Elastica\Query\Bool;
use Elastica\Query\Match;
use Elastica\Query\Term;
use FOS\ElasticaBundle\Repository;

class VoitureElasticaRepository extends Repository {

    public function search($searchText){
        $query = new Bool();
        $matchModele = new Match();
        $matchMarque = new Match();
        $matchUser = new Match();
        $matchModele->setField('modele.nom',$searchText);
        $matchMarque->setField('modele.marque.nom',$searchText);
        $matchUser->setField('user.nom',$searchText);

        $query->addShould($matchModele)
            ->addShould($matchMarque)
            ->addShould($matchUser);

        return new Query($query);
    }
} 