<?php

namespace Post\ComposerTest;

class Order extends Api
{

    /**
     * 订单创建(门店方式)
     *
     * @param array $params
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function createByShop(array $params)
    {
        return $this->request('order/createByShop', $params);
    }

    /**
     * 查询订单状态
     *
     * @param array $params
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function queryStatus(array $params)
    {
        return $this->request('order/status/query', $params);
    }

}