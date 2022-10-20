<?php


namespace Zyan\Tp3Sitemap;

/**
 * Class Factory.
 *
 * @package Zyan\Tp3Sitemap
 *
 * @author 读心印 <aa24615@qq.com>
 */
class Factory
{
    /**
     * sitemap.
     *
     * @param string $path
     *
     * @return Sitemap
     *
     * @author 读心印 <aa24615@qq.com>
     */
    public static function sitemap($baseUrl){
        return new Sitemap($baseUrl);
    }

    private function __construct()
    {

    }
}