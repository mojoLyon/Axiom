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
 * Class Context contains the informational context for a rule execution
 * Information are represented by a set of Proposition and Variable elements
 *
 * @package MojoLyon\Axiom
 * @author  Stéphane Reuille <stephane.reuille@gmail.com>
 */
class Context extends Rule{

    /**
     * Can't add operators in context
     *
     * @param string $name Operator name
     *
     * @throws \DomainException
     *
     * @return void
     */
    public function operator($name) {
        throw new \DomainException("Can't add operators to rule context");
    }

    /**
     * Find contextual element by name
     *
     * @param string $name Name of element
     *
     * @return RuleElement\Element|null
     */
    public function findElement($name)
    {
        foreach ($this->getElements() as $element) {
            if ($element->getName() == $name) {
                return $element;
            }
        }

        return null;
    }
} 