<?php

namespace MojoLyon\Axiom\test\units;

use atoum;
use MojoLyon\Axiom\RuleOverride as base;

class RuleOverride extends atoum{

    public function testConstructor()
    {
        $this->object($override = new base('testoverride', true))
             ->string($override->getName())
                ->isEqualTo('testoverride')
             ->boolean($override->getValue())
                ->isTrue()
        ;

        $this->exception(function(){ new base('testoverride', 'badargument');})
                ->isInstanceOf('\InvalidArgumentException')
        ;

    }

    public function testRaisedBy()
    {
        $override = new base('test', true);

        $manager = new \mock\MojoLyon\Axiom\ManagerInterface;
        $manager->getMockController()->getAxiomManager = function(){ return 'test user';};

        $this->object($override->setRaisedBy($manager))
                ->isInstanceof('MojoLyon\Axiom\RuleOverride')
             ->object($raisedBy = $override->getRaisedBy())
                ->isInstanceof($manager)
             ->string($raisedBy->getAxiomManager())
                ->isEqualTo('test user')
        ;
    }

    public function testAuthorizedBy()
    {
        $override = new base('test', true);

        $manager = new \mock\MojoLyon\Axiom\ManagerInterface;
        $manager->getMockController()->getAxiomManager = function(){ return 'test user';};

        $this->object($override->setAuthorizedBy($manager))
                ->isInstanceof('MojoLyon\Axiom\RuleOverride')
            ->object($authorizedBy = $override->getAuthorizedBy())
                ->isInstanceof($manager)
            ->string($authorizedBy->getAxiomManager())
                ->isEqualTo('test user')
        ;
    }

    public function testWhen()
    {
        $override = new base('test', true);
        $when = new \DateTime();
        $this->object($override->setWhen($when))
                ->isInstanceOf('MojoLyon\Axiom\RuleOverride')
             ->object($override->getWhen())
                ->isInstanceOf('\DateTime')
                ->isEqualTo($when)
        ;
    }

    public function testWhy()
    {
        $override = new base('test', true);
        $this->object($override->setWhy('why test'))
            ->isInstanceOf('MojoLyon\Axiom\RuleOverride')
            ->string($override->getWhy())
            ->isEqualTo('why test')
        ;
    }
} 