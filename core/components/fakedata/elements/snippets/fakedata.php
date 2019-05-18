<?php
/** @var modX $modx */
/** @var array $scriptProperties */
/** @var fakeData $fakeData */

$corePath = $modx->getOption('fakedata_core_path', null, MODX_CORE_PATH . 'components/fakedata/', false);

$fakeData = $modx->getService('fakeData', 'fakeData', $corePath . 'model/', $scriptProperties);
if (!$fakeData) {
    return 'Could not load fakeData class!';
}
$functionName = $modx->getOption('functionName', $scriptProperties, '');
$options = $modx->getOption('options', $scriptProperties, array());

return $fakeData->create($functionName, $options);