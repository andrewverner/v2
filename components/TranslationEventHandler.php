<?php
/**
 * Created by PhpStorm.
 * User: Denis Khodakovskiy
 * Date: 22.05.19
 * Time: 10:51
 */

namespace app\components;

use yii\i18n\MissingTranslationEvent;
use Exception;
use Yii;

class TranslationEventHandler
{
    public static function handleMissingTranslation(MissingTranslationEvent $event)
    {
        try {
            $translationsFilePath = Yii::getAlias('@app') . '/messages/ru-RU/app.php';
            $translations = require $translationsFilePath;
            $translations[$event->message] = '';
            ksort($translations);

            $str = '<?php' . PHP_EOL;
            $str .= 'return [' . PHP_EOL;
            foreach ($translations as $key => $value) {
                $str .= "   '{$key}' => '{$value}'," . PHP_EOL;
            }
            $str .= '];' . PHP_EOL;

            file_put_contents($translationsFilePath, $str);
        } catch (Exception $exception) {

        }

        return "@@@{$event->message}";
    }
}
