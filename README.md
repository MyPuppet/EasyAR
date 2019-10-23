# EasyAR
PHP EasyAR官方SDK集成

>加入时间戳参数使SDK在国内外服务器通用
>加入搜索识别目标方法

安装:

`composer require mypuppet/easy-ar-sdk`

用法:

```
use EasyARSdk\EasyARClientSdkCRS;

$appKey = '这里是Cloud Key';
$appSecret = '这里是Cloud Secret';
$appHost = '这里是Cloud URLs 不含端口的部分!!例如 xxx.cn1.crs.easyar.com';
$timestamp = time(); //当你的时区配置为UTC+8时删除此行及实例化时传参处该参数

$sdk = new EasyARClientSdkCRS($appKey, $appSecret, $appHost, $timestamp);

# 测试响应
$sdk->ping();
# 取识别图列表
$sdk->targets($limit, $last);
# 取识别图详情信息
$sdk->info($targetId);
# 添加识别图
$sdk->targetAdd($params);
# 更新识别图
$sdk->targetUpdate($targetId, $params);
# 删除识别图
$sdk->delete($targetId);
# 取识别图数量
$sdk->targetsCount();
# 相似识别图列表
$sdk->similar($image);
# 识别图识别级别
$sdk->detection($image);
# 搜索识别目标
$sdk->search($image);
```