<?php

/*
 * This is free and unencumbered software released into the public domain.
 * 
 * Anyone is free to copy, modify, publish, use, compile, sell, or
 * distribute this software, either in source code form or as a compiled
 * binary, for any purpose, commercial or non-commercial, and by any
 * means.
 * 
 * In jurisdictions that recognize copyright laws, the author or authors
 * of this software dedicate any and all copyright interest in the
 * software to the public domain. We make this dedication for the benefit
 * of the public at large and to the detriment of our heirs and
 * successors. We intend this dedication to be an overt act of
 * relinquishment in perpetuity of all present and future rights to this
 * software under copyright law.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
 * OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
 * ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 * 
 * For more information, please refer to <http://unlicense.org/>
 * 
 * @package
 * @copyright  Copyright (c) 2009-2012 Soflomo (http://soflomo.com)
 * @license    http://unlicense.org Unlicense
 */

namespace Simple\Service;

use DateTime;
use Zend\Http;
use Zend\Json\Json;
use Zend\Filter;

/**
 * Description of Twitter
 */
class Twitter
{
    protected $id     = '137523638533488640';
    //protected $uri    = 'http://httpbin.org/post'; 
    protected $uri    = 'https://api.twitter.com/1/statuses/destroy/137523638533488640.json';
    protected $method = Http\Request::METHOD_POST;
    protected $status = '';
    protected $secret = array();
    
    public function __construct($consumer_secret, $token_secret)
    {
        $this->status = utf8_encode('This is a test tweet from SlmCmf');
        
        $this->secret['consumer'] = $consumer_secret;
        $this->secret['token']    = $token_secret;
    }
    
    public function updateStatus()
    {
        echo '<pre>';
        
        $oauth  = $this->getOAuthString();
        $header = Http\Header\Authorization::fromString('Authorization: ' . $oauth);
        //$params = array('status' => rawurlencode($this->status));
        
        $client = new Http\Client;
        $client->setUri($this->uri)
               ->setMethod($this->method)
               ->setHeaders(array($header));
               //->setParameterPost($params);
        
        $response = $client->send();
        
        echo "Result from request:\n";
        echo var_dump((array) Json::decode($response->getBody()));
        echo '</pre>';
    }
    
    protected function getOAuthString()
    {
        $filter = new Filter\Alpha;
        $nonce  = $filter->setAllowWhiteSpace(false)
                         ->filter(base64_encode(mt_rand()));
        $now    = new DateTime;
        
        $args = array(
            'oauth_consumer_key'     => 'XB2fIWcF5MVSGMhrG9rqA',
            'oauth_nonce'            => $nonce,
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp'        => $now->format('U'),
            'oauth_token'            => '2272821-LBDucruT9KQNBAINooCwaDqbgkxayO6gSUEiIe2A',
            'oauth_version'          => '1.0'
        );
        
        $args['oauth_signature'] = $this->getSignature($args);
        
        echo "Unescaped signature:\n";
        var_dump($args['oauth_signature']);
        echo "\n";
        
        ksort($args);
        $argsEncoded = array();
        foreach ($args as $key => $value) {
            $argsEncoded[] = sprintf('%s="%s"',
                                     rawurlencode($key),
                                     rawurlencode($value)
                             );
        }
        $header  = 'OAuth ';
        $header .= implode(', ', $argsEncoded);
        
        echo "Escaped auth string:\n";
        var_dump($header);
        echo "\n";
        
        return $header;
    }
    
    protected function getSignature(array $args)
    {
        //$args['status'] = $this->status;
        ksort($args);
        
        $params = array();
        foreach($args as $key => $value) {
            $params[] = sprintf('%s=%s',
                                     rawurlencode($key),
                                     rawurlencode($value)
                             );
        }
        $params = implode('&', $params);
        
        echo "Encoded paramters:\n";
        var_dump($params);
        echo "\n";
        
        $signature = $this->method
                   . '&' . rawurlencode($this->uri)
                   . '&' . rawurlencode($params);
        
        echo "Signature base string:\n";
        var_dump($signature);
        echo "\n";
        
        $key = rawurlencode($this->secret['consumer']) . '&' . rawurlencode($this->secret['token']);
        
        echo "Key:\n";
        var_dump($key);
        echo "\n";
        
        return base64_encode(hash_hmac('sha1', $signature, $key));
    }
}