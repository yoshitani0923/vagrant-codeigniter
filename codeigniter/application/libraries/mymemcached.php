<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mymemcached {

    private $cache;
    private $session;
    private $option = array('cache_compress' => false,
                            'cache_expire' => 0);

    function __construct()
    {
    	$CI =& get_instance();
        $CI->load->library('session');
        $CI->load->driver('cache', array('adapter' => 'memcached'));
    	$this->session = $CI->session;
    	$this->cache = $CI->cache;
    }

    public function loadCache($namespace, $key)
    {
        $keyName = $this->creatCacheKey($namespace, $key);
        return $this->get($keyName);
    }

    public function saveCache($namespace, $key, $value, $option = null)
    {
        $keyName = $this->creatCacheKey($namespace, $key);
        return $this->set(
        	$keyName,
        	$value,
        	$option !== null ? $option : $this->option
        	);
    }
    
    public function deleteCache($namespace, $key = null)
    {
        if ($key === null) {
        	$plus = $this->cache->memcached->get($namespace) + 1;
            return $this->cache->save($namespace, $plus);
        } else {
        	$keyName = $this->creatCacheKey($namespace, $key);
        	return $this->cache->save($namespace, $keyName);
        }
    }
    
    public function flushCache($namespace, $key)
    {

    }
    
    private function set($key, $item, $option)//単純に登録してあげるfunction
    {
        return $this->cache->save(
        	$key,
        	$item,
            $option['cache_compress'],
            $option['cache_expire']
        );
    }
    
    private function get($key)//単純にデータを取ってくるfunction
    {
        return $this->cache->get($key);
        //echo $data;

    }
    
    private function delete($key)
    {
        return $this->cache->delete($key);//書き換える！！！
        //echo '【デリート後の$key→'.$key.'】';
    }
    
    /* -----このファンクションはいらない。deleteCache内で完結させた！-----
    public function increment($key, $value)
    {
        return $memcache->increment($key, $value);
    }*/
    
    private function flush($namespace, $key)
    {

    }
    
    public function creatCacheKey($namespace, $key)//キーの名前を決めてあげるfunction
    {
        $namespaceKey = $this->get($namespace);
        if ($namespaceKey === false/*ここ本当にnull？もしくはfalse？*/) {
        	$namespaceKey = 0;
        	$this->set($namespace, $namespaceKey, $this->option);
        }
        return "${namespace}:${namespaceKey}:${key}";
    }
}

/* End of file Someclass.php */