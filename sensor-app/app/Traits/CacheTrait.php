<?php
declare(strict_types=1);

namespace App\Http\Traits;
use App\Http\Facades\Logger;
use App\Http\Helpers\LogHelper;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\{App, Cache};

/**
 * Created by PhpStorm.
 * User: Yarusha
 * Date: 08.06.2022
 * Time: 18:17
 */
trait CacheTrait
{
    /**
     * @param string $cacheName
     * @param int $ttl
     * @param callable $functionForCache
     * @return array
     */
    public function getCachedData(string $cacheName, int $ttlCache, callable $functionForCache) : array {
        try {
            return Cache::remember(App::environment() . $cacheName, $ttlCache,
                function() use ($functionForCache, $cacheName) {
                    $result = call_user_func($functionForCache);
                    if (!count($result))
                        throw new \RuntimeException('Error get: '.$cacheName);
                    return $result;
                });
        } catch (\RuntimeException $exception) {
            Logger::error(__CLASS__ . ':::' . LogHelper::exceptionString($exception));
            return [];
        }
    }

    /**
     * @param string $cacheName
     * @param int $ttlCache
     * @param callable $functionForCache
     * @return Collection
     */
    public function getCachedDataCollection(string $cacheName, int $ttlCache, callable $functionForCache) : Collection {
        try {
            return Cache::remember(App::environment() . $cacheName, $ttlCache,
                function() use ($functionForCache, $cacheName) {
                    $result = call_user_func($functionForCache);
                    if ($result->isEmpty())
                        throw new \RuntimeException('Error get: '.$cacheName);
                    return $result;
                });
        } catch (\RuntimeException $exception) {
            Logger::error(__CLASS__ . ':::' . LogHelper::exceptionString($exception));
            return collect([]);
        }
    }
}
