<?
require_once __DIR__.'/vendor/autoload.php';

use \PhpOop\stragery\ConcreteStrategyA;
use \PhpOop\stragery\ConcreteStrategyB;

use \PhpOop\stragery\Context;


$a = new ConcreteStrategyA();
$b = new ConcreteStrategyB();
$context = new Context($a);
echo "Client: Strategy is set to normal sorting.\n";
$context->doSomeBusinessLogic();

echo "<br/>";

$context = new Context($b);
echo "Client: Strategy is set to reverse sorting..\n";
$context->doSomeBusinessLogic();