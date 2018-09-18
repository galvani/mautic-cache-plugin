<?php

declare(strict_types=1);

namespace MauticPlugin\MauticCacheBundle\Cache;

/*
 * @copyright   2018 Mautic Inc. All rights reserved
 * @author      Mautic, Inc. Jan Kozak <galvani78@gmail.com>
 *
 * @link        http://mautic.com
 * @created     12.9.18
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

use Psr\Cache\CacheItemInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\AbstractAdapter;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Cache\CacheItem;
use Symfony\Component\Cache\Simple\Psr6Cache;

/**
 * Class CacheProvider provides caching mechanism using adapters, it provides both PSR-6 and PSR-16
 *
 * @package MauticPlugin\MauticCacheBundle\Cache
 */
final class CacheProvider implements AdapterInterface
{
    /**
     * @var AbstractAdapter
     */
    private $adapter;

    /**
     * @var Psr6Cache
     */
    private $psr16;

    /**
     * @param AdapterInterface $adapter
     */
    public function setCacheAdapter(AdapterInterface $adapter): void
    {
        $this->adapter = $adapter;
    }

    /**
     * @return AbstractAdapter
     */
    public function getCacheAdapter(): ?AbstractAdapter
    {
        return $this->adapter;
    }

    /**
     * Returns PSR-16 cache object
     *
     * @return Psr6Cache
     */
    public function getCache()
    {
        if (is_null($this->psr16)) {
            $this->psr16 = new Psr6Cache($this->getCacheAdapter());
        }

        return $this->psr16;
    }

    /**
     * {@inheritdoc}
     *
     * @return CacheItem
     */
    public function getItem($key): CacheItem
    {
        return $this->getCacheAdapter()->getItem($key);
    }

    /**
     * {@inheritdoc}
     *
     * @return \Traversable|CacheItem[]
     */
    public function getItems(array $keys = [])
    {
        return $this->getCacheAdapter()->getItems($keys);
    }

    /**
     * Confirms if the cache contains specified cache item.
     * Note: This method MAY avoid retrieving the cached value for performance reasons.
     * This could result in a race condition with CacheItemInterface::get(). To avoid
     * such situation use CacheItemInterface::isHit() instead.
     *
     * @param string $key
     *                    The key for which to check existence
     *
     * @throws invalidArgumentException
     *                                  If the $key string is not a legal value a \Psr\Cache\InvalidArgumentException
     *                                  MUST be thrown
     *
     * @return bool
     *              True if item exists in the cache, false otherwise
     */
    public function hasItem($key): bool
    {
        return $this->getCacheAdapter()->hasItem($key);
    }

    /**
     * Deletes all items in the pool.
     *
     * @return bool
     *              True if the pool was successfully cleared. False if there was an error.
     */
    public function clear(): bool
    {
        return $this->getCacheAdapter()->clear();
    }

    /**
     * Removes the item from the pool.
     *
     * @param string $key
     *                    The key to delete
     *
     * @throws invalidArgumentException
     *                                  If the $key string is not a legal value a \Psr\Cache\InvalidArgumentException
     *                                  MUST be thrown
     *
     * @return bool
     *              True if the item was successfully removed. False if there was an error.
     */
    public function deleteItem($key): bool
    {
        return $this->getCacheAdapter()->deleteItem($key);
    }

    /**
     * Removes multiple items from the pool.
     *
     * @param string[] $keys
     *                       An array of keys that should be removed from the pool
     *
     * @throws invalidArgumentException
     *                                  If any of the keys in $keys are not a legal value a \Psr\Cache\InvalidArgumentException
     *                                  MUST be thrown
     *
     * @return bool
     *              True if the items were successfully removed. False if there was an error.
     */
    public function deleteItems(array $keys): bool
    {
        return $this->getCacheAdapter()->deleteItems($keys);
    }

    /**
     * Persists a cache item immediately.
     *
     * @param cacheItemInterface $item
     *                                 The cache item to save
     *
     * @return bool
     *              True if the item was successfully persisted. False if there was an error.
     */
    public function save(CacheItemInterface $item): bool
    {
        return $this->getCacheAdapter()->save($item);
    }

    /**
     * Sets a cache item to be persisted later.
     *
     * @param cacheItemInterface $item
     *                                 The cache item to save
     *
     * @return bool
     *              False if the item could not be queued or if a commit was attempted and failed. True otherwise.
     */
    public function saveDeferred(CacheItemInterface $item): bool
    {
        return $this->getCacheAdapter()->saveDeferred($item);
    }

    /**
     * Persists any deferred cache items.
     *
     * @return bool
     *              True if all not-yet-saved items were successfully saved or there were none. False otherwise.
     */
    public function commit(): bool
    {
        return $this->getCacheAdapter()->commit();
    }
}
