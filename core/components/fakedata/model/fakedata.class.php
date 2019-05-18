<?php

require_once 'Faker/src/autoload.php';

class fakeData
{
    /** @var modX $modx */
    public $modx;
    private $faker;


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
        $assetsUrl = MODX_ASSETS_URL . 'components/fakedata/';
        $corePath = $this->modx->getOption('fakedata_core_path', null, MODX_CORE_PATH . 'components/fakedata/', false);

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',

            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
        ], $config);

        // Подключаем Faker

        if(require_once $this->modx->getOption('fakedata_core_path', null, MODX_CORE_PATH . 'components/fakedata/', false) . 'model/Faker/src/autoload.php'){
            // use the factory to create a Faker\Generator instance
            $this->faker = Faker\Factory::create();
        }

        $this->modx->addPackage('fakedata', $this->config['modelPath']);
        $this->modx->lexicon->load('fakedata:default');
    }


    public function create($functionName = '', $options){
        if(!$functionName || $functionName == ''){
            return 'Function name is empty';
        }

        if(!is_array($options)){
            $options = explode(',', $options);
            $options = array_map('trim', $options);
        }

        try{
            return $this->faker->format($functionName, $options ? : array());

        }catch (Exception $e){
            return 'Ошибка: ' . $e->getMessage();
        }

    }


}






















