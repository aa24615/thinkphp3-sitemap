

# zyan/laravel-thinkphp3

thinkphp3框架 sitemap快速生成

## 要求

1. php >= 7.2
2. Composer

## 安装

```shell
composer require zyan/thinkphp3-sitemap -vvv
```

## 使用

```php
use Zyan\Sitemap\Sitemap;

//根地址
$baseUrl = 'http://www.php127.com/';

$sitemap = Factory::tp3Sitemap($baseUrl);
$sitemap->table('表名')->where(['where条件 可不传'])->field(['字段'])->url('url规则')->make();

//可生成多个表
$sitemap->table('表名')->url('url规则')->make();
```

table

```php
//不需要填写前缀
$sitemap->table('article')->make(); 
```


where[可选]

```php
//请参考tp3手册中where传数组的方法 
$sitemap->table('article')->where([['id','>',1000],['state','=',1]])->make(); 
```

field
```php
//请参考tp3手册field传的方法 注意这里转换成数组 
$sitemap->table('article')->field(['id','...'])->make();
```

url

```php
//配合field字段为变量替换url 请用{}括起来
$sitemap->table('article')->field(['id'])->url('/article/{uid}.html')->make();
//可以有多个
$sitemap->table('article')->field(['id','type'])->url('/article/{type}/{uid}.html')->make();
//也可以指定域名 不指定默认以 读取 config('app.url') 
$sitemap->table('article')->field(['id','type'])->url('http://www.php127.com/article/{id}.html')->make();
```

make
```php
//开始生成
$sitemap->table('article')->field(['id'])->url('/user/{id}.html')->make();
```

## 生成结果
暂时仅支持txt格式 /sitemap/map.txt 为索引文件对应下面的url  请将这里的网址添加到百度站长即可 
```json
http://www.php127.com/sitemap/article_1.txt
http://www.php127.com/sitemap/article_2.txt
http://www.php127.com/sitemap/article_3.txt
...
```
/sitemap/表名_分页.txt      
/sitemap/article_1.txt      
/sitemap/article_2.txt      
/sitemap/article_3.txt          

> 以上是默认目录的生成结果,如果您指定了目录,请自行修改上传后对应该路径

## 相关包

- [laravel-sitemap](https://github.com/aa24615/laravel-sitemap)
- [thinkphp3-sitemap](https://github.com/aa24615/thinkphp3-sitemap)
- [thinkphp-sitemap](https://github.com/aa24615/thinkphp-sitemap)
- [sitemap-output](https://github.com/aa24615/sitemap-output)
- [sitemap-url](https://github.com/aa24615/sitemap-url)

## 参与贡献

1. fork 当前库到你的名下
2. 在你的本地修改完成审阅过后提交到你的仓库
3. 提交 PR 并描述你的修改，等待合并

## License

[MIT license](https://opensource.org/licenses/MIT)
