<?php
namespace MojoLyon\Axiom\RuleElement\test\units;

use atoum;
use MojoLyon\Axiom\RuleElement\Proposition as base;

/**
 * Axiom Proposition Element test
 */
class Proposition extends atoum
{

    public function testConstruct()
    {
        $base = new base('testname');
        $this->variable($base->getValue())
                ->isNull()
             ->variable($base->getName())
                ->isEqualTo('testname')
        ;

        $this->assert
             ->exception(function() {
                new base('testname', 'testval');
            })
            ->isInstanceOf('\InvalidArgumentException')
        ;

        $base = new base('testname', true);
        $this->variable($base->getName())
                ->isEqualTo('testname')
             ->boolean($base->getValue())
                ->isTrue()
        ;
    }

    public function testSetValue()
    {
        $base = new base('testname');
        $this->assert
             ->exception(function() use($base) {
                $base->setValue('test');
            })
                ->isInstanceOf('\InvalidArgumentException')
             ->object($base->setValue(false))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
             ->boolean($base->getValue())
                ->isFalse()
        ;
    }
} 