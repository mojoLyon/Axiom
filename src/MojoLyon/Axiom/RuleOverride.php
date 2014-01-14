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

/**
 * Class RuleOverride is used by Ruleset to override a specific rule
 *
 * @package MojoLyon\Axiom
 */
class RuleOverride {
    /**
     * Name of the rule to override
     * @var string
     */
    private $name;

    /**
     * Value of the override
     * @var boolean
     */
    private $value;

    /**
     * The person who's raised the override
     * @var ManagerInterface
     */
    private $raisedBy;

    /**
     * The person who's authorized the override
     * @var ManagerInterface
     */
    private $authorizedBy;

    /**
     * Date the override was made
     * @var \DateTime
     */
    private $when;

    /**
     * Why the override was made
     * @var string
     */
    private $why;

    /**
     * Constructor
     *
     * @param string  $name  Name of tre rule to override
     * @param boolean $value Value of the override
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        if (!is_bool($value)) {
            throw new \InvalidArgumentException('Value must be a boolean');
        }
        $this->value = $value;
    }

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter for value
     *
     * @return boolean
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Setter for authorizedBy
     *
     * @param ManagerInterface $authorizedBy
     *
     * @return RuleOverride
     */
    public function setAuthorizedBy(ManagerInterface $authorizedBy)
    {
        $this->authorizedBy = $authorizedBy;

        return $this;
    }

    /**
     * Getter for authorizedBy
     *
     * @return ManagerInterface
     */
    public function getAuthorizedBy()
    {
        return $this->authorizedBy;
    }

    /**
     * Setter for raisedBy
     *
     * @param ManagerInterface $raisedBy
     *
     * @return RuleOverride
     */
    public function setRaisedBy(ManagerInterface $raisedBy)
    {
        $this->raisedBy = $raisedBy;

        return $this;
    }

    /**
     * Getter for raisedBy
     *
     * @return ManagerInterface
     */
    public function getRaisedBy()
    {
        return $this->raisedBy;
    }

    /**
     * Setter for when
     *
     * @param \DateTime $when
     *
     * @return RuleOverride
     */
    public function setWhen(\DateTime $when)
    {
        $this->when = $when;

        return $this;
    }

    /**
     * Getter for when
     *
     * @return \DateTime
     */
    public function getWhen()
    {
        return $this->when;
    }

    /**
     * Setter for why
     *
     * @param string $why
     *
     * @return RuleOverride
     */
    public function setWhy($why)
    {
        $this->why = $why;

        return $this;
    }

    /**
     * Getter for why
     *
     * @return string
     */
    public function getWhy()
    {
        return $this->why;
    }


} 