# EasyAR
PHP EasyAR官方SDK集成

>加入时间参数修复官方时间写死导致的小Bug

安装:

`composer require mypuppet/easy-ar-sdk`

用法:

```
namespace EasyARSdk;

$appKey = '这里是Cloud Key';
$appSecret = '这里是Cloud Secret';
$appHost = '这里是Server-end (Target Mangement) URL';
$timestamp = time();

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
```