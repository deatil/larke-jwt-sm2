# larke-admin 后台管理系统的 SM2 驱动

larke-admin 后台管理系统 JWT 的 SM2 驱动


## 项目介绍

*  基于 `lpilp/guomi` 的 `larke-admin` 的 SM2 驱动
*  使用 `SM2` 作为验证驱动, 满足国内要求


## 环境要求

 - PHP >= 8.1


## 安装步骤

1. 下载安装

```php
composer require lake/larke-jwt-sm2
```

2. 更改配置文件

```php
larkeadmin.jwt.signer.algorithm = 'GmSM2'
larkeadmin.jwt.signer.private_key = 'sm2/path/prihex.file'
larkeadmin.jwt.signer.public_key = 'sm2/path/pubhex.file'
```

sm2 使用 hex 编码的明文私钥和公钥，文件内也就填入 hex 编码的明文私钥和公钥


## 开源协议

*  本库遵循 `Apache2` 开源协议发布，在保留本系统版权的情况下提供个人及商业免费使用。 


## 版权

*  该系统所属版权归 deatil(https://github.com/deatil) 所有。
