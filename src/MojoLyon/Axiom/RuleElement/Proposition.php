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
 * Class Element is an abstract class used by all rule elements
 *
 * @package MojoLyon\Axiom\RuleElement
 * @author  Stéphane Reuille <stephane.reuille@gmail.com>
 *
 */
class Proposition extends Element
{
    /**
     * Value of the rule proposition
     * @var mixed
     */
    private $value;

    /**
     * Constructor
     *
     * @param string  $name  The proposition name
     * @param boolean $value Proposition value
     */
    public function __construct($name, $value = null)
    {
        parent::__construct($name);
        if (null !== $value) {
            $this->setValue($value);
        }
    }

    /**
     * Getter for proposition value
     *
     * @return boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Setter for proposition value
     *
     * @param boolean $value Value of proposition
     *
     * @throws \InvalidArgumentException
     *
     * @return Proposition
     */
    public function setValue($value)
    {
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('Value for a proposition must be a boolean');
        }
        $this->value = $value;

        return $this;
    }
}