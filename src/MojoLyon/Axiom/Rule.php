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

use MojoLyon\Axiom\RuleElement;

/**
 * Class Rule represents a constraint on the operation of the software
 * The rule is represented by a set of RuleElement in Reverse Polish Notation
 *
 * @package MojoLyon\Axiom
 */
class Rule
{
    /**
     * Rule elements
     * @var array
     */
    private $elements;

    /**
     * Evaluation data
     * @var array
     */
    private $stack;

    /**
     * Constructor
     */
    public function __construct() {
        $this->elements = array();
        $this->stack = array();
    }

    /**
     * Add element to rule
     *
     * @param RuleElement\Element $element Element to add
     *
     * @return Rule
     */
    public function add(RuleElement\Element $element) {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * Add proposition to rule
     *
     * @param string  $name  Name of proposition
     * @param boolean $value Value of proposition
     *
     * @return Rule
     */
    public function proposition($name, $value) {
        $this->add(new RuleElement\Proposition($name, $value));

        return $this;
    }

    /**
     * Add operator to rule
     *
     * @param string $name Name of operator
     *
     * @return Rule
     */
    public function operator($name) {
        $this->add(new RuleElement\Operator($name));

        return $this;
    }

    /**
     * Add variable to rule
     *
     * @param string $name  Name of variable
     * @param mixed  $value Value of variable
     *
     * @return Rule
     */
    public function variable($name, $value) {
        $this->add(new RuleElement\Variable($name, $value));

        return $this;
    }

    /**
     * Evaluate the rule
     *
     * Apply context values on rule elements then evaluate rule
     *
     * @param Context $context Context for rule evaluation
     *
     * @throws \UnexpectedValueException
     *
     * @return RuleElement\Proposition
     */
    public function evaluate(Context $context)
    {
        foreach ($this->elements as $rule) {
            if ($rule instanceof RuleElement\Operator) {
                continue;
            }

            $contextEl = $context->findElement($rule->getName());
            if ($contextEl === null) {
                continue;
            }
            if (!$rule instanceof $contextEl) {
                throw new \UnexpectedValueException("Context element type doesn't match rule element type ");
            }
            $rule->setValue($contextEl->getValue());
        }

        return $this->process();
    }

    /**
     * Getter for rule elements
     *
     * @return array
     */
    protected function getElements()
    {
        return $this->elements;
    }

    /**
     * Return the number of arguments required by an operator
     *
     * @param int $num Number of argument
     *
     * @return array
     */
    private function getArguments($num) {
        $num *= -1;

        return array_reverse(array_splice($this->stack, $num));

    }

    /**
     * Process evaluation of the rule
     *
     * @throws \LogicException
     *
     * @return RuleElement\Proposition
     */
    private function process()
    {
        foreach ($this->elements as $rule) {
            if ($rule instanceof RuleElement\Operator) {
                $numberArguments = $rule->getNumberOfParameters();
                $args = $this->getArguments($numberArguments);

                $result = $rule($args);

                if (!$result instanceof RuleElement\Proposition) {
                    throw new \LogicException('Operator must return a proposition');
                }

                $this->stack[] = $result;

                continue;
            }


            $this->stack[] = $rule;
        }

        return array_pop($this->stack);
    }
}