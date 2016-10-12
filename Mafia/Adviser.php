<?php
namespace Mafia;

/**
 * Class Adviser
 * Советник семьи, человек, которому дон может доверять и к советам которого прислушивается.
 * Он служит посредником при разрешении спорных вопросов,
 * выступает посредником между доном и подкупленными политическими,
 * профсоюзными или судебными деятелями либо выполняет роль представителя семьи
 * на встречах с другими семьями. У консильери, как правило, нет собственной «команды»,
 * но они имеют значительное влияние в семье.
 * При этом у консильери обычно есть и законный бизнес, например,
 * адвокатская практика или работа биржевым маклером.
 */
class Adviser
{
    /** @var array */
    private static $links;
    const PUBLIC = __DIR__ . '/../public/';
    const CORPSES = self::PUBLIC . 'corpses/';

    public function __construct()
    {
        self::$links = file(self::PUBLIC . 'sacrifice.txt');

        self::createDir(self::CORPSES);

        foreach (self::$links as $link) {
            $link = self::filterLink($link);
            self::createDir($link);
        }
    }

    /**
     * @param $link
     * @return string
     */
    private static function filterLink($link)
    {
        $link = trim($link);
        $url = parse_url($link);
        return self::CORPSES . $url['host'];
    }

    /**
     * @return array
     */
    public function getLinks()
    {
        return self::$links;
    }

    /**
     * Сохранение данных в файл
     * @param $file
     * @param $data
     */
    public static function storeLinks($file, $data)
    {
        file_put_contents(self::CORPSES . $file, $data, FILE_APPEND | LOCK_EX);
    }

    /**
     * Создание директорий
     * @param $dir
     * @return bool
     */
    private static function createDir($dir)
    {
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        return true;
    }

    /**
     * @param string $dir
     */
    public static function clearCorpses(string $dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir")
                        self::clearCorpses($dir . "/" . $object);
                    else unlink($dir . "/" . $object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }
}
