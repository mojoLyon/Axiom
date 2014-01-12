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
 * Class DateVariable represent a variable of type DateTime
 *
 * @package MojoLyon\Axiom\RuleElement
 * @author  Stéphane Reuille <stephane.reuille@gmail.com>
 *
 */
class DateVariable extends Variable{
    /**
     * Constructor
     *
     * @param string    $name Name of variable
     * @param \DateTime $date Value of variable
     */
    public function __construct($name, \DateTime $date = null)
    {
        parent::__construct($name, $date);
    }


} 