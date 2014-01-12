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
 * Class Operators are operators to apply on Proposition or Variable elements
 *
 * @package MojoLyon\Axiom\RuleElement
 * @author  Stéphane Reuille <stephane.reuille@gmail.com>
 *
 */
class Operator extends Element{
    /**#@+
     * Operators list
     */
    const LOGICAL_AND = 'and';
    const LOGICAL_OR  = 'or';
    const LOGICAL_NOT = 'not';
    const LOGICAL_XOR = 'xor';
    const EQUAL_TO = '==';
    const NOT_EQUAL_TO = '!=';
    const GREATHER_THAN = '>';
    const LESSER_THAN = '<';
    const GREATHERTHAN_OR_EQUAL = '>=';
    const LESSERTHAN_OR_EQUAL = '<=';
    /**#@+ */

    /**
     * List of operator
     * @var array
     */
    protected static $operators = array();

    /**
     * Current operator function
     * @var \closure
     */
    protected $closure;

    /**
     * Constructor
     *
     * @param string $name Operator name
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($name)
    {
        if (!array_key_exists($name, self::getOperators())) {
            throw new \InvalidArgumentException("Operator $name doesn't exists");
        }
        parent::__construct($name);
        $this->closure = self::$operators[$name];
    }

    /**
     * Invoke operator closure
     *
     * @param array $arguments Closure's parameters
     *
     * @return Proposition
     */
    public function __invoke(array $arguments)
    {
        return call_user_func_array($this->closure, $arguments);
    }

    /**
     * Return closure parameters number
     *
     * @return int
     */
    public function getNumberOfParameters()
    {
        $reflection = new \ReflectionFunction($this->closure);

        return $reflection ->getNumberOfParameters();
    }

    /**
     * Return operators closure
     *
     * @return array
     */
    protected static function getOperators()
    {
        if (empty(self::$operators)) {
            self::$operators = self::getInternalOperator();
        }

        return self::$operators;
    }

    /**
     * Array of operator
     *
     * @return array
     */
    protected static function getInternalOperator()
    {
        return array(
            'and' => function (Proposition $left, Proposition $right) {
                    $name =  "({$right->getName()} and {$left->getName()})";
                    $value = ($right->getValue() and $left->getValue());

                    return new Proposition($name, $value);
                }
            , 'or' => function (Proposition $left, Proposition $right) {
                    $name =  "({$right->getName()} or {$left->getName()})";
                    ($value = $right->getValue() or $left->getValue());

                    return new  Proposition($name, $value);
                }
            , 'xor' => function (Proposition $left, Proposition $right) {
                    $name =  "({$right->getName()} xor {$left->getName()})";
                    $value = ($right->getValue() xor $left->getValue());

                    return new  Proposition($name, $value);
                }
            , 'not' => function (Proposition $right) {
                    $name =  "(not {$right->getName()})";
                    $value = (!$right->getValue());

                    return new  Proposition($name, $value);
                }
            , '==' => function (Variable $left, Variable $right) {
                    $name =  "({$right->getName()} == {$left->getName()})";
                    $value = ($right->getValue() == $left->getValue());

                    return new Proposition($name, $value);
                }
            , '!=' => function (Variable $left, Variable $right) {
                    $name =  "({$right->getName()} != {$left->getName()})";
                    $value = ($right->getValue() != $left->getValue());

                    return new Proposition($name, $value);
                }
            , '>' => function (Variable $left, Variable $right) {
                    $name =  "({$right->getName()} > {$left->getName()})";
                    $value = ($right->getValue() > $left->getValue());

                    return new Proposition($name, $value);
                }
            , '<' => function (Variable $left, Variable $right) {
                    $name =  "({$right->getName()} < {$left->getName()})";
                    $value = ($right->getValue() < $left->getValue());

                    return new Proposition($name, $value);
                }
            , '>=' => function (Variable $left, Variable $right) {
                    $name =  "({$right->getName()} >= {$left->getName()})";
                    $value = ($right->getValue() >= $left->getValue());

                    return new Proposition($name, $value);
                }
            , '<=' => function (Variable $left, Variable $right) {
                    $name =  "({$right->getName()} <= {$left->getName()})";
                    $value = ($right->getValue() <= $left->getValue());

                    return new Proposition($name, $value);
                }
        );
    }
}