<?php

namespace Twitter\Controller;

use Zend\Mvc\Controller\ActionController;

use Zend\Cache\Storage\Adapter\AdapterInterface as Cache;

use Zend\Http\Client;
use Zend\Json\Decoder;
use Zend\View\Model\JsonModel;

class TwitterController extends ActionController
{
    const TIMELINE_URL = 'https://twitter.com/statuses/user_timeline/%s.json';
    const CACHE_KEY    = 'twitter_cache_%s';
    const CACHE_TTL    = 3600; // Store twitter result for one hour
    
    /**
     * @var Cache
     */
    protected $cache;
    
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
    }
    
    public function indexAction()
    {
        $config = $this->getServiceLocator()->get('config');
        $user   = $config['twitter']['username'];       
        
        $key = sprintf(self::CACHE_KEY, $user);
        if (null === $this->cache || null === ($result = $this->cache->getItem($key))) {
            $uri    = sprintf(self::TIMELINE_URL, $user);
            $client = new Client($uri);

            $response = $client->send();
            $result   = $response->getBody();
            
            if (null !== $this->cache) {
                $this->cache->setItem($key, $result, array('ttl' => self::CACHE_TTL));
            }
        }
        
        $timeline = Decoder::decode($result);
        
        return new JsonModel(array('timeline' => $timeline));
    }
}
