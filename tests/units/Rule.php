<?php
namespace MojoLyon\Axiom\test\units;

use atoum;

use MojoLyon\Axiom\Rule as base;
class Rule extends atoum
{
    public function testSetter()
    {
        $rule = new base('ruletest');
        $this->object($rule->proposition('test', true))
                ->isInstanceOf('MojoLyon\Axiom\Rule')
             ->object($rule->variable('test2', 'val'))
                ->isInstanceOf('MojoLyon\Axiom\Rule')
             ->object($rule->operator('and'))
                ->isInstanceOf('MojoLyon\Axiom\Rule')
            ->object($rule->add(new \MojoLyon\Axiom\RuleElement\DateVariable('date', new \DateTime())))
                ->isInstanceOf('MojoLyon\Axiom\Rule')
            ->string($rule->getName())
                ->isEqualTo('ruletest')
        ;
    }

    public function testEvaluateBadContext()
    {
        $rule = new base('ruletest');
        $rule->proposition('test', true)
             ->variable('test2', 'test2');

        $context = new \MojoLyon\Axiom\Context('ruletest');
        $context->proposition('test', false)
                ->proposition('test2', true);

        $this->exception(
            function() use($rule, $context) {
                $rule->evaluate($context);
            }
            )->isInstanceOf('\UnexpectedValueException')
        ;
    }

    public function testEvaluate()
    {
        $rule = new base('ruletest');
        $rule->proposition('test', true)
             ->proposition('test2', true)
             ->proposition('test3', true)
             ->operator('or')
             ->operator('and')
        ;

        $context = new \MojoLyon\Axiom\Context('ruletest');
        $this->object($result = $rule->evaluate($context))
                ->isInstanceOf('\MojoLyon\Axiom\RuleElement\Proposition')
             ->string($result->getName())
                ->isEqualTo('(test and (test2 or test3))')
             ->boolean($result->getValue())
                ->isTrue()
        ;

        $context->proposition('test', false);
        $this->object($result = $rule->evaluate($context))
                ->isInstanceOf('\MojoLyon\Axiom\RuleElement\Proposition')
            ->string($result->getName())
                ->isEqualTo('(test and (test2 or test3))')
            ->boolean($result->getValue())
                ->isFalse()
        ;
    }
} 