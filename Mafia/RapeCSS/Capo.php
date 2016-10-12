<?php
namespace Mafia\RapeCSS;

/**
 * Class Capo
 * Капо, или капитан — глава «команды», или «боевой группы» (состоящей из «солдат»),
 * который несёт ответственность за один или несколько видов криминальной деятельности
 * в определённом районе города и ежемесячно отдаёт боссу часть доходов,
 * получаемых с этой деятельности («засылает долю»).
 *
 * В семье обычно 6—9 таких команд, и в каждой из них — до 10 солдат.
 * Капо подчиняется подручному либо самому дону.
 * Представление в капо делает подручный, но непосредственно капо назначает лично дон.
 */
class Capo
{
    /** @var Soldier[] */
    private $squad;

    /**
     * Capo
     * @param string $link
     */
    public function __construct(string $link)
    {
        $html = new \DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $html->loadHTMLFile($link);

        libxml_use_internal_errors($internalErrors);
        $this->planSquad($html, $link);
        $this->execute();
    }

    /**
     * Prepare the squad
     * @param \DOMDocument $html
     * @param string $link
     */
    private function planSquad(\DOMDocument $html, string $link)
    {
        $this->squad = [
            new Inline($html, $link),
            new Embedding($html, $link),
            new Linking($html, $link),
        ];
    }

    /**
     * "Talk with that link"
     */
    private function execute()
    {
        foreach ($this->squad as $soldier) {
            $soldier->store();
        }
    }
}
