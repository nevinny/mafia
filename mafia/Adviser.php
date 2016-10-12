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

        foreach (self::$links as $link) {
            self::createDir($link);
        }
    }

    public function getLinks()
    {
        return self::$links;
    }

    public static function storeLinks($file, $data)
    {
        file_put_contents(self::CORPSES . $file, $data, FILE_APPEND | LOCK_EX);
    }

    private static function createDir($link)
    {
        $url = parse_url($link);
        $dir = explode('.', $url['host']);
        if (!is_dir(self::CORPSES . $dir[1])) {
            mkdir(self::CORPSES . $dir[1]);
        }
    }
}
