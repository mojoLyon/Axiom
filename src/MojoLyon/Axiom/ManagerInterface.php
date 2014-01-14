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
 * Interface Manager is used by RuleOverride
 *
 * Axiom manager is used by ruleOverride to specify the person who raised the override
 * and the person who authorized the override
 *
 * @package MojoLyon\Axiom
 */
interface ManagerInterface {
    /**
     * Getting the name of manager
     *
     * @return mixed
     */
    public function getAxiomManager();
} 