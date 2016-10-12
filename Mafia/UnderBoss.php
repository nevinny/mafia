<?php
namespace Mafia;

/**
 * Class UnderBoss
 * «Заместитель» дона, второй человек в семье, который назначается самим доном.
 * Подручный несёт ответственность за действия всех капо.
 * В случае ареста или смерти дона подручный обычно становится действующим доном.
 */
class UnderBoss
{
    private static $link = 'http://www.alexa.com/topsites';

    /**
     * Сбор списка жертв
     */
    public static function fillSacrifice()
    {
        // todo : get information from self::$link and send it to Adviser.
    }
}
