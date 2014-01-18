<?php
/**
 * This file is part of the Axiom package.
 *
 * (c) Stéphane Reuille <stephane.reuille@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MojoLyon\Axiom;

use MojoLyon\Axiom\RuleElement\Proposition;

/**
 * Class RuleSet represents a set of Rule element
 *
 * RuleSet can be evaluate to true if and only if all rules are evaluate to true
 * RuleOverride can be applied to one or more rule in the set
 *
 * @package MojoLyon\Axiom
 */
class RuleSet {
    /**
     * Name of the ruleset
     * @var string
     */
    private $name;

    /**
     * List of rules
     * @var array
     */
    private $rules;

    /**
     * List of rule ovveride
     * @var array
     */
    private $ruleOverride;

    /**
     * Constructor
     *
     * @param string $name Name of the ruleset
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->rules = array();
        $this->ruleOverride = array();
    }

    /**
     * Setter for the name of ruleset
     *
     * @param string $name
     *
     * @return RuleSet
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }

    /**
     * Add rule
     *
     * @param Rule $rule Rule to add in collection
     *
     * @throws \DomainException
     *
     * @return RuleSet
     */
    public function addRule(Rule $rule)
    {
        if (array_key_exists($rule->getName(), $this->rules)) {
            throw new \DomainException("No duplicates rule allowed");
        }
        $this->rules[$rule->getName()] = $rule;

        return $this;
    }

    /**
     * Add rule
     *
     * @param RuleOverride $ruleOverride Rule override to add
     *
     * @throws \DomainException
     *
     * @return RuleSet
     */
    public function addRuleOverride(RuleOverride $ruleOverride)
    {
        if (array_key_exists($ruleOverride->getName(), $this->ruleOverride)) {
            throw new \DomainException("No duplicates rule override allowed");
        }
        $this->ruleOverride[$ruleOverride->getName()] = $ruleOverride;

        return $this;
    }

    /**
     * Evaluate the ruleset
     *
     * @param Context $context Context for rules evaluation
     *
     * @return Proposition
     */
    public function evaluate(Context $context)
    {
        $resultValue = true;
        foreach ($this->rules as $rule) {
            if ($this->isOverriden($rule)) {
                $ruleResult = $this->ruleOverride[$rule->getName()];
            } else {
                $ruleResult = $rule->evaluate($context);
            }

            $resultValue = ($resultValue and $ruleResult->getValue());
        }

        return new Proposition($this->name, $resultValue);
    }

    /**
     * Return if a rule is overriden by a RuleOverride
     *
     * @param Rule $rule Rule to check
     *
     * @return bool
     */
    private function isOverriden(Rule $rule) {
        return array_key_exists($rule->getName(), $this->ruleOverride);
    }
} 