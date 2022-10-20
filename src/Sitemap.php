<?php

namespace Zyan\Tp3Sitemap;


class Sitemap
{
    protected $tableName = null;
    protected $where = [];
    protected $field = [];
    protected $url = null;
    protected $map = [];
    protected $path = '';
    protected $baseUrl = '';
    public function __construct($baseUrl)
    {
        $this->baseUrl = rtrim($baseUrl,'/').'/';
        $this->path = './sitemap/';
    }

    protected function getTable(){
        return M($this->tableName);
    }

    public function table(string $tableName){
        $this->tableName = $tableName;
        return $this;
    }

    public function where(array $where){
        $this->where = $where;
        return $this;
    }

    public function field(array $field){
        $this->field = $field;
        return $this;
    }

    public function url(string $url){
        $this->url = $this->baseUrl.ltrim($url,'/');
        return $this;
    }

    protected function write($p,$content){
        file_put_contents($this->path.$this->tableName.'_'.$p.'.txt',$content);
        $this->map[] = $this->baseUrl.'sitemap/'.$this->tableName.'_'.$p.'.txt';
    }

    public function make(){
        $count = $this->getTable()->where($this->where)->count();
        $p = ceil($count/50000);
        $i = 1;

        while ($i<=$p){
            $url = [];
            $list = $this->getTable()->where($this->where)->field(join(',',$this->field))->limit(($i-1)*50000,$i*50000)->select();
            foreach ($list as $val){
                $url[] = $this->getUrl($val);
            }

            $this->write($i,join("\n",$url));
            $i++;
        }
    }

    protected function getUrl($obj){
        $url = $this->url;
        foreach ($this->field as $field){
            $url = str_replace('{'.$field.'}',$obj[$field],$url);
        }
        return $url;
    }

    public function __destruct()
    {
        file_put_contents($this->path.'map.txt',join("\n",$this->map));
    }
}
