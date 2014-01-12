<?php
namespace MojoLyon\Axiom\RuleElement\test\units;

use atoum;
use MojoLyon\Axiom\RuleElement\Variable as base;

/**
 * Axiom Proposition Element test
 */
class Variable extends atoum
{
    public function testConstruct()
    {
        $base = new base('testname');
        $this->variable($base->getValue())
                ->isNull()
            ->variable($base->getName())
                ->isEqualTo('testname')
        ;

        $base = new base('testname', 'testvalue');
        $this->variable($base->getName())
                ->isEqualTo('testname')
            ->variable($base->getValue())
                ->isEqualTo('testvalue')
        ;
    }

    public function testSetValue()
    {
        $base = new base('testname');
        $this->object($base->setValue('testValue'))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Variable')
             ->variable($base->getValue())
                ->isEqualTo('testValue')
        ;
    }
} 