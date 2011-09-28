#!/usr/bin/env php
<?php
set_include_path(implode(PATH_SEPARATOR, array(realpath(__DIR__ . '/library/ZendFramework2/library'),'.')));
require_once 'Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array('Zend\Loader\StandardAutoloader' => array()));

use Zend\Config\Config,
    Zend\Di\Configuration,
    Zend\Di\Definition,
    Zend\Di\DependencyInjector;

$config = new Config (array(
    'di' => array('instance' => array(
        'alias' => array(
            'view'  => 'Zend\View\PhpRenderer',
        ),
        'Zend\View\PhpRenderer' => array(
            'parameters' => array(
                'resolver' => 'Zend\View\TemplatePathStack',
                'options'  => array(
                    'script_paths' => array(
                        'application' => __DIR__ . '/../views',
                    ),
                ),

            ),
        ),
        'Foo' => array(
            'parameters' => array(
                'bar' => 'Bar', // works, detected as object
                'baz' => 'Baz', // doesn't work
                'optional' => 'something', // doesn't work
                'string' => 'hello', // works, no alias or class found, string used
            ),
        ),
    )),
));

class Foo
{
    protected $bar;
    protected $baz;
    protected $string;

    public function setBar($bar)
    {
        $this->bar = $bar;
    }

    public function getBar()
    {
        return $this->bar;
    }

    public function setBaz($baz, $optional = null)
    {
        $this->baz = $baz;
        if (null !== $optional) {
            // blah
        }
    }

    public function getBaz()
    {
        return $this->baz;
    }

    public function setString($string)
    {
        $this->string = $string;
    }

    public function getString()
    {
        return $this->string;
    }
}

class Bar{}
class Baz{}

$definition = new Definition\AggregateDefinition;
$definition->addDefinition(new Definition\RuntimeDefinition);

$di = new DependencyInjector();
$di->setDefinition($definition);

$config = new Configuration($config->di);
$config->configure($di);

$renderer = $di->get('Zend\View\PhpRenderer');
if (count($renderer->resolver()->getPaths()) == 0) {
    echo "BAD: Zend\View\PhpRenderer->setResolver(\$resolver, \$options) was NOT called.\n";
} else {
    echo "GOOD: Zend\View\PhpRenderer->setResolver(\$resolver, \$options) WAS called.\n";
}

$foo = $di->get('Foo');
if (!$foo->getBaz() instanceof Baz) {
    echo "BAD: Foo->setBaz(\$baz, \$optional = null) was NOT called.\n";
} else {
    echo "GOOD: Foo->setBaz(\$baz, \$optional = null) WAS called.\n";
}

if (!$foo->getBar() instanceof Bar) {
    echo "BAD: Foo->setBar(\$bar) was NOT called.\n";
} else {
    echo "GOOD: Foo->setBar(\$bar) WAS called.\n";
}

if ($foo->getString() !== 'hello') {
    echo "BAD: Foo->setString(\$string) was NOT called.\n";
} else {
    echo "GOOD: Foo->setString(\$string) WAS called.\n";
}
