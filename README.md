# mautic-cache-plugin

Enables PSR-6 and PSR-16 caching

## Installation

Install this

## Usage

### PSR-6

```php
        /** @var CacheProvider $cache */
        $cache = $this->get('mautic.cache.provider');
        
        $test = $cache->getItem('test_value');
        $test->set('lalalala');
        $cache->save($test);
        
        var_dump($cache->hasItem('test_value'));
        
        var_dump($gen = $cache->getItems(['test_value']));
        var_dump($gen->current());
```

### PSR-16

```php
        /** @var CacheProvider $cache */
        $cache = $this->get('mautic.cache.provider');


        $simpleCache = $cache->getCache();
        $test = $simpleCache->get('test_value');

        var_dump($test);
```