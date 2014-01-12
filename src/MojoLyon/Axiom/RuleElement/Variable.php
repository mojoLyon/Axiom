<?php
/**
 * This file is part of the Axiom package.
 *
 * (c) Stéphane Reuille <stephane.reuille@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace MojoLyon\Axiom\RuleElement;

/**
 * Class Variable is an formal logic variable
 *
 * @package MojoLyon\Axiom\RuleElement
 * @author  Stéphane Reuille <stephane.reuille@gmail.com>
 *
 */
class Variable  extends Element{
    /**
     * Value of the rule proposition
     * @var mixed
     */
    protected $value;

    /**
     * Constructor
     *
     * @param string $name  Name of the variable
     * @param mixed  $value Value of the variable
     */
    public function __construct($name, $value = null)
    {
        parent::__construct($name);
        $this->setValue($value);
    }

    /**
     * Getter for variable value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Setter for proposition value
     *
     * @param boolean $value Value of variable
     *
     * @return Variable
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }
} 