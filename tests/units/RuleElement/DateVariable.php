<?php
namespace MojoLyon\Axiom\RuleElement\test\units;
use atoum;
use MojoLyon\Axiom\RuleElement\DateVariable as base;

class DateVariable extends atoum{
    public function testConstruct()
    {
        $base = new base('testname');
        $this->variable($base->getValue())
                ->isNull()
            ->variable($base->getName())
                ->isEqualTo('testname')
        ;
        $curdate = new \DateTime();
        $base = new base('testname', $curdate);
        $this->variable($base->getName())
                ->isEqualTo('testname')
            ->variable($base->getValue())
                ->isEqualTo($curdate)
        ;
    }

    public function testSetValue()
    {
        $base = new base('testname');
        $curdate = new \DateTime();
        $this->object($base->setValue($curdate))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\DateVariable')
            ->variable($base->getValue())
                ->isEqualTo($curdate)
        ;
    }
} 