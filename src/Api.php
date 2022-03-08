<?php

namespace Post\ComposerTest;

use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{
    private $appKey;

    private $secret;

    const URL = 'https://peisongopen.meituan.com/api';

    public function signature(array $params)
    {
        ksort($params);

        $waitSign = '';
        foreach ($params as $key => $item) {
            if ($item) {
                $waitSign .= $key.$item;
            }
        }

        return strtolower(sha1($this->secret.$waitSign));
    }

    /**
     * @param string $method
     * @param array $params
     * @return mixed
     * @throws MeituanDispatchException
     */
    public function request(string $method, array $params)
    {
        $params = array_merge($params, [
            'appkey' => $this->appKey,
            'timestamp' => time(),
            'version' => '1.0',
        ]);

        $params['sign'] = $this->signature($params);

        $http = $this->getHttp();

        $response = $http->post(self::URL . $method, $params);

        $result = json_decode(strval($response->getBody()), true);

        $this->checkErrorAndThrow($result);

        return $result;
    }

    /**
     * @param $result
     * @throws MeituanDispatchException
     */
    private function checkErrorAndThrow($result)
    {
        if (!$result || $result['code'] != 0) {
            throw new MeituanDispatchException($result['message'], $result['code']);
        }
    }


}