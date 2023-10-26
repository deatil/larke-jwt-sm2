# JWT SM2 驱动

larke-admin 后台管理系统 JWT 的 SM2/SM3 驱动


## 项目介绍

*  基于 `lpilp/guomi` 的 `larke-admin` 的 SM2 驱动
*  使用 `SM2` 和 `SM3` 作为 JWT 验证驱动, 满足国内要求
*  JWT 配置标识为 `GmSM2` 和 `GmSM3`
*  使用 `SM3` 需要 `openssl` 支持 `SM3` 版本


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
和
```php
larkeadmin.jwt.signer.algorithm = 'GmSM3'
larkeadmin.jwt.signer.secrect = base64_encode("123123")
```

SM2 字符时使用 HEX 编码的明文私钥和公钥。
使用文件时可使用 PKCS1 和 PKCS8 编码的 SM2 私钥，公钥默认只有一种类型。
密钥可查看 `docs/key` 文件夹 


## 开源协议

*  本库遵循 `Apache2` 开源协议发布，在保留本系统版权的情况下提供个人及商业免费使用。 


## 版权

*  该系统所属版权归 deatil(https://github.com/deatil) 所有。
