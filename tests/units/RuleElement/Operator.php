<?php
namespace MojoLyon\Axiom\RuleElement\test\units;
use atoum;
use MojoLyon\Axiom\RuleElement\Operator as base;
use MojoLyon\Axiom\RuleElement\Proposition;
use MojoLyon\Axiom\RuleElement\Variable;

/**
 * Axiom Operator Element test
 */
class Operator extends atoum
{
    public function testConstruct()
    {
        $this->exception(function(){ new base('unknowoperator');})
                ->isInstanceOf('\InvalidArgumentException')
        ;
    }

    public function testAndOperator()
    {

        $base = new base(base::LOGICAL_AND);

        $this->variable($base->getName())
                ->isEqualTo('and')
             ->object($object = $base(array(new Proposition('proposition 1', true), new Proposition('proposition 2', true))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
             ->variable($object->getName())
                ->isEqualTo('(proposition 2 and proposition 1)')
             ->boolean($object->getValue())
                ->isTrue()
             ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testOrOperator()
    {

        $base = new base(base::LOGICAL_OR);

        $this->variable($base->getName())
                ->isEqualTo('or')
            ->object($object = $base(array(new Proposition('proposition 1', true), new Proposition('proposition 2', false))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 or proposition 1)')
            ->boolean($object->getValue())
                ->isFalse()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testXorOperator()
    {
        $base = new base(base::LOGICAL_XOR);

        $this->variable($base->getName())
                ->isEqualTo('xor')
            ->object($object = $base(array(new Proposition('proposition 1', true), new Proposition('proposition 2', true))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 xor proposition 1)')
            ->boolean($object->getValue())
                ->isFalse()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testNotOperator()
    {
        $base = new base(base::LOGICAL_NOT);

        $this->variable($base->getName())
                ->isEqualTo('not')
            ->object($object = $base(array(new Proposition('proposition 1', true))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(not proposition 1)')
            ->boolean($object->getValue())
                ->isFalse()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(1)
        ;
    }

    public function testEqualOperator()
    {
        $base = new base(base::EQUAL_TO);

        $this->variable($base->getName())
                ->isEqualTo('==')
            ->object($object = $base(array(new Variable('proposition 1', 'test'), new Variable('proposition 2', 'test'))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 == proposition 1)')
            ->boolean($object->getValue())
                ->isTrue()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testNotEqualOperator()
    {
        $base = new base(base::NOT_EQUAL_TO);

        $this->variable($base->getName())
                ->isEqualTo('!=')
            ->object($object = $base(array(new Variable('proposition 1', 'test'), new Variable('proposition 2', 'test2'))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 != proposition 1)')
            ->boolean($object->getValue())
                ->isTrue()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testGreatherOperator()
    {
        $base = new base(base::GREATHER_THAN);

        $this->variable($base->getName())
                ->isEqualTo('>')
            ->object($object = $base(array(new Variable('proposition 1', 10), new Variable('proposition 2', 20))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 > proposition 1)')
            ->boolean($object->getValue())
                ->isTrue()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testLesserOperator()
    {
        $base = new base(base::LESSER_THAN);

        $this->variable($base->getName())
                ->isEqualTo('<')
            ->object($object = $base(array(new Variable('proposition 1', 10), new Variable('proposition 2', 20))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 < proposition 1)')
            ->boolean($object->getValue())
                ->isFalse()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testGreatherOrEqualOperator()
    {
        $base = new base(base::GREATHERTHAN_OR_EQUAL);

        $this->variable($base->getName())
                ->isEqualTo('>=')
            ->object($object = $base(array(new Variable('proposition 1', 10), new Variable('proposition 2', 10))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 >= proposition 1)')
            ->boolean($object->getValue())
                ->isTrue()
            ->object($object = $base(array(new Variable('proposition 1', 10), new Variable('proposition 2', 9))))
            ->boolean($object->getValue())
                ->isFalse()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }

    public function testLesserOrEqualOperator()
    {
        $base = new base(base::LESSERTHAN_OR_EQUAL);

        $this->variable($base->getName())
            ->isEqualTo('<=')
            ->object($object = $base(array(new Variable('proposition 1', 10), new Variable('proposition 2', 10))))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
            ->variable($object->getName())
                ->isEqualTo('(proposition 2 <= proposition 1)')
            ->boolean($object->getValue())
                ->isTrue()
            ->object($object = $base(array(new Variable('proposition 1', 10), new Variable('proposition 2', 9))))
            ->boolean($object->getValue())
                ->isTrue()
            ->integer($base->getNumberOfParameters())
                ->isEqualTo(2)
        ;
    }
} 