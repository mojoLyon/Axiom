<?php

namespace MojoLyon\Axiom\test\units;

use atoum;


use MojoLyon\Axiom\RuleSet as base;

class RuleSet extends atoum{
    public function testRulesetadd()
    {
        $rule = new \MojoLyon\Axiom\Rule('test');
        $rule->proposition('test', true);

        $override = new \MojoLyon\Axiom\RuleOverride('test', true);

        $base = new base('testruleset');
        $this->object($base->addRule($rule))
                ->isInstanceOf($base)
             ->object($base->addRuleOverride($override))
                ->isInstanceOf($base)
             ->exception(function() use ($base, $rule) {$base->addRule($rule);})
                 ->isInstanceOf('\DomainException')
            ->exception(function() use ($base, $override) {$base->addRuleOverride($override);})
                ->isInstanceOf('\DomainException')
        ;

    }

    public function testEvaluateTrue()
    {
        $rule = new \MojoLyon\Axiom\Rule('test');
        $rule->proposition('test', true);

        $rule2 = new \MojoLyon\Axiom\Rule('test2');
        $rule2->proposition('test2', true);

        $context = new \MojoLyon\Axiom\Context('test');
        $context->proposition('test', true);
        $context->proposition('test2', true);

        $base = new base('testruleset');
        $base->addRule($rule);
        $base->addRule($rule2);
        $this->object($proposition = $base->evaluate($context))
                ->isInstanceOf('\MojoLyon\Axiom\RuleElement\Proposition')
             ->string($proposition->getName())
                ->isEqualTo('testruleset')
             ->boolean($proposition->getValue())
                ->isTrue()
        ;
    }

    public function testEvaluateFalse()
    {
        $rule = new \MojoLyon\Axiom\Rule('test');
        $rule->proposition('test', true);

        $rule2 = new \MojoLyon\Axiom\Rule('test2');
        $rule2->proposition('test2', true);

        $context = new \MojoLyon\Axiom\Context('test');
        $context->proposition('test', true);
        $context->proposition('test2', false);

        $base = new base('testruleset');
        $base->addRule($rule);
        $base->addRule($rule2);
        $this->object($proposition = $base->evaluate($context))
                ->isInstanceOf('\MojoLyon\Axiom\RuleElement\Proposition')
             ->string($proposition->getName())
                ->isEqualTo('testruleset')
             ->boolean($proposition->getValue())
                ->isFalse()
        ;
    }

    public function testEvaluateTrueWithRuleoverride()
    {
        $rule = new \MojoLyon\Axiom\Rule('test');
        $rule->proposition('test', true);

        $rule2 = new \MojoLyon\Axiom\Rule('test2');
        $rule2->proposition('test2', true);

        $context = new \MojoLyon\Axiom\Context('test');
        $context->proposition('test', true);
        $context->proposition('test2', false);

        $ruleoverride = new \MojoLyon\Axiom\RuleOverride('test2', true);

        $base = new base('testruleset');
        $base->addRule($rule);
        $base->addRule($rule2);
        $base->addRuleOverride($ruleoverride);
        $this->object($proposition = $base->evaluate($context))
                ->isInstanceOf('\MojoLyon\Axiom\RuleElement\Proposition')
             ->string($proposition->getName())
                ->isEqualTo('testruleset')
             ->boolean($proposition->getValue())
                ->isTrue()
        ;
    }

    public function testEvaluateFalseWithRuleoverride()
    {
        $rule = new \MojoLyon\Axiom\Rule('test');
        $rule->proposition('test', true);

        $rule2 = new \MojoLyon\Axiom\Rule('test2');
        $rule2->proposition('test2', true);

        $context = new \MojoLyon\Axiom\Context('test');
        $context->proposition('test', true);
        $context->proposition('test2', true);

        $ruleoverride = new \MojoLyon\Axiom\RuleOverride('test', false);

        $base = new base('testruleset');
        $base->addRule($rule);
        $base->addRule($rule2);
        $base->addRuleOverride($ruleoverride);
        $this->object($proposition = $base->evaluate($context))
                ->isInstanceOf('\MojoLyon\Axiom\RuleElement\Proposition')
             ->string($proposition->getName())
                ->isEqualTo('testruleset')
             ->boolean($proposition->getValue())
                ->isFalse()
        ;
    }
} 