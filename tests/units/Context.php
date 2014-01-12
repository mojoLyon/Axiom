<?php
namespace MojoLyon\Axiom\test\units;

use atoum;
use MojoLyon\Axiom\Context as base;
class Context extends atoum{
    public function testContext()
    {
        $context = new base();
        $this->object($context->proposition('proposition 1', true))
                ->isInstanceOf('MojoLyon\Axiom\Context')
             ->object($context->variable('variable 1', 'valeur var 1'))
                ->isInstanceOf('MojoLyon\Axiom\Context')
             ->exception(function() use($context) {$context->operator('and');})
                ->isInstanceOf('\DomainException')
             ->object($object1 = $context->findElement('proposition 1'))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Proposition')
             ->object($object2 = $context->findElement('variable 1'))
                ->isInstanceOf('MojoLyon\Axiom\RuleElement\Variable')
             ->variable($context->findElement('notset'))
                ->isNull()
             ->string($object1->getName())
                ->isEqualTo('proposition 1')
             ->boolean($object1->getValue())
                ->isTrue()
            ->string($object2->getName())
                ->isEqualTo('variable 1')
            ->string($object2->getValue())
                ->isEqualTo('valeur var 1')
            ;
    }
} 