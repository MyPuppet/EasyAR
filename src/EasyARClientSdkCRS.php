<?php

/**
 * EasyARClientSdkCRS.php
 *
 * @author    MyPuppet <909898509@qq.com>
 * @copyright 2019 MyPuppet <909898509@qq.com>
 *
 * @see      https://github.com/mypuppet
 */

namespace EasyARSdk;

/**
 * Class EasyARClientSdkCRS
 * @package EasyARSdk
 */
class EasyARClientSdkCRS
{
    /**
     * Cloud Key
     * @var
     */
    private $appKey;

    /**
     * Cloud Secret
     * @var
     */
    private $appSecret;

    /**
     * Cloud URLs (Server-end)
     * @var string
     */
    private $appHost;

    /**
     * EasyARClientSdkCRS constructor.
     * @param $appKey
     * @param $appSecret
     * @param $appHost
     * @param null $timestamp
     */
    function __construct($appKey, $appSecret, $appHost, $timestamp = null)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->appHost = 'http://' . $appHost;

        $this->timestamp = $timestamp ? $timestamp : time();
    }

    /**
     * 当前时间戳
     * @var int|null
     */
    private $timestamp;

    /**
     * @return mixed
     */
    public function ping()
    {
        $rs = Http::get($this->appHost . '/ping', '');
        return json_decode($rs);
    }

    /**
     * 取识别图列表
     * @param $limit
     * @param $last
     * @return mixed
     */
    public function targets($limit, $last)
    {
        $params['limit'] = (string)$limit;
        $params['last'] = (string)$last;
        $params = $this->getSign($params);
        $rs = Http::get($this->appHost . '/targets/', $params);
        return json_decode($rs);
    }

    /**
     * 取识别图详情信息
     * @param $targetId
     * @return mixed
     */
    public function info($targetId)
    {
        $params = $this->getSign();
        $rs = Http::get($this->appHost . '/target/' . $targetId, $params);
        return json_decode($rs);
    }

    /**
     * 删除识别图
     * @param $targetId
     * @return mixed
     */
    public function delete($targetId)
    {
        $params = $this->getSign();
        $rs = Http::delete($this->appHost . '/target/' . $targetId, $params);
        return json_decode($rs);
    }

    /**
     * 添加识别图
     * @param array $params
     *            image: base64后识别图，必须
     *            active: 是否启用：0为否, 1为是，必须
     * @return mixed
     */
    public function targetAdd($params)
    {
        $params['type'] = 'ImageTarget';
        $params = $this->getSign($params);
        $data = json_encode($params);
        $headers = [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data)
        ];

        $rs = Http::post($this->appHost . '/targets/', $data, $headers);
        return json_decode($rs);
    }

    /**
     * 更新识别图
     * @param string $targetId 识别图id
     * @param array $params
     * @return mixed
     */
    public function targetUpdate($targetId, $params)
    {
        $params = $this->getSign($params);
        $data = json_encode($params);
        $headers = [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data)
        ];

        $rs = Http::put($this->appHost . '/target/' . $targetId, $data, $headers);
        return json_decode($rs);
    }

    /**
     * 取识别图数量
     * @return mixed
     */
    public function targetsCount()
    {
        $params = $this->getSign();
        $rs = Http::get($this->appHost . '/targets/count', $params);
        return json_decode($rs);
    }

    /**
     * 相似识别图列表
     * @param string $image base64后识别图
     * @return mixed
     */
    public function similar($image)
    {
        $params['image'] = $image;
        $params = $this->getSign($params);
        $data = json_encode($params);
        $headers = [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data)
        ];

        $rs = Http::post($this->appHost . '/similar/', $data, $headers);
        return json_decode($rs);
    }


    /**
     * 识别图识别级别
     * @param string $image base64后识别图
     * @return mixed
     */
    public function detection($image)
    {
        $params['image'] = $image;
        $params = $this->getSign($params);
        $data = json_encode($params);
        $headers = [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($data)
        ];

        $rs = Http::post($this->appHost . '/grade/detection/', $data, $headers);
        return json_decode($rs);
    }

    /**
     * 取当前时间
     * @return bool|string
     */
    private function getDate()
    {
        return date('Y-m-d\TH:i:s.000\Z', $this->timestamp);
    }

    /**
     * 参数签名
     * @param array $params
     * @return array
     */
    private function getSign($params = [])
    {
        $params['appKey'] = $this->appKey;
        $params['date'] = $this->getDate();
        ksort($params);

        $tmp = [];
        foreach ($params as $k => $v) {
            if (is_string($v)) $tmp[] = $k . $v;
        }

        $str = implode('', $tmp);
        $params['signature'] = sha1($str . $this->appSecret);
        return $params;
    }
}