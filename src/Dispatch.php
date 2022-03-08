<?php

namespace Post\ComposerTest;

use Hanson\Foundation\Foundation;

/**
 * Class Dispatch
 * @package Cblink\MeituanDispatch
 *
 * @property \Post\ComposerTest\Test         $test
 *
 * @method array createByShop($params)
 * @method array queryStatus($params)
 */
class Dispatch extends Foundation
{
    private $order;

    protected $providers = [
        TestServiceProvider::class
    ];

    public function __construct($config)
    {
        parent::__construct($config);
        $this->order = new Order($config['appKey'],$config['secret']);
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement __call() method.

        $this->order->{$name}(...$arguments);
    }




}