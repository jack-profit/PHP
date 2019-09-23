<?php
/*
 * now 手机归属地接口访问类
 */

class nowapi
{
    public function nowapi_call($param)
    {
        if(!is_array($param))
        {
            return false;
        }
        $param['format'] = empty($param['format']) ? 'json' : $param['format'];
        $api_url = empty($param['apiurl']) ? 'http://api.k780.com/?' : $param['apiurl'].'/?';
        unset($param['apiurl']);
        // 拼接接口访问地址
        foreach($param as $k=>$v)
        {
            $api_url .= $k.'='.$v.'&';
        }
        // 访问接口
        $api_url = substr($api_url, 0, -1);
        if(!$call_api = file_get_contents($api_url))
        {
            return false;
        }
        // 处理返回结果
        if($param['format'] == 'base64')
        {
            $a_cdata = unserialize(base64_decode($call_api));
        }else if($param['format'] == 'json'){
            if(!$a_cdata = json_decode($call_api, true))
            {
                return false;
            }
        }else{
            return false;
        }
        // 打印错误代码及信息
        if($a_cdata['success'] != 1)
        {
            echo $a_cdata['msgid'].' '.$a_cdata['msg'];
            return false;
        }
        // 返回成功结果
        return $a_cdata['result'];
    }
}