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
abstract class Element
{
    /**
     * Element's name
     *
     * @var string
     */
    protected $name;

    /**
     * Constructor
     *
     * @param string $name Name of element
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Getter for element name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}