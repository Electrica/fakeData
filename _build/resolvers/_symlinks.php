<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/fakeData/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/fakedata')) {
            $cache->deleteTree(
                $dev . 'assets/components/fakedata/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/fakedata/', $dev . 'assets/components/fakedata');
        }
        if (!is_link($dev . 'core/components/fakedata')) {
            $cache->deleteTree(
                $dev . 'core/components/fakedata/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/fakedata/', $dev . 'core/components/fakedata');
        }
    }
}

return true;