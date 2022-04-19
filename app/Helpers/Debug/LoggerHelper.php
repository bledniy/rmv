<?php

namespace App\Helpers\Debug;

use Psr\Log\LoggerInterface;

class LoggerHelper
{
    private $prefixCache = 'logs.';

    public function error($err)
    {
        $this->log($err, 'error');
    }

    private function log($log, $context)
    {
        if ($this->isLogExists($log)) {
            return;
        }
        if (!($logger = $this->getLogger()) || !method_exists($logger, $context)) {
            return;
        }
        try {
            $logger->{$context}($log);
            $this->addLogToCache($log);
        } catch (\Exception $e) {
            if (isLocalEnv()) {
                d($e);
            }
        }
    }

    private function makeKeyCache($log): string
    {
        $key = microtime(true);
        if (is_string($log)) {
            $key = md5($log);
        }
        if (is_object($log)) {
            if ($log instanceof \Exception) {
                $key = md5($log->getMessage());
            } else {
                $key = spl_object_hash($log);
            }
        }

        return $this->addPrefixCache($key);
    }

    private function isLogExists($log)
    {
        return \Cache::has($this->makeKeyCache($log));
    }

    private function addLogToCache($log)
    {
        return \Cache::set($this->makeKeyCache($log), 1, 3600);
    }

    private function addPrefixCache(string $key)
    {
        return $this->prefixCache . $key;
    }


    /**
     * @return LoggerInterface|null
     */
    private function getLogger(): ?LoggerInterface
    {
        return logger();
    }
}