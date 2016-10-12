<?php
namespace Mafia\RapeCSS;

/**
 * Class Soldier
 * Самый младший член семьи, которого «ввели» в семью,
 * во-первых, поскольку он доказал для неё свою полезность,
 * а во-вторых, по рекомендации одного или нескольких капо.
 * После избрания солдат обычно попадает в ту команду, капо которой рекомендовал его.
 */
abstract class Soldier
{
    /** @var \DOMDocument */
    protected $html;

    /** @var string */
    protected $indexCSS = 'index.css';

    public function __construct(\DOMDocument $html, string $link)
    {
        $this->html = $html;
        $this->link = $link;
    }

    protected function getDomain()
    {
        // todo: more accurate check
        $path = parse_url($this->link);
        $host = $path['host'];

        $hosts = explode('.', $host);
        return $hosts[1];
    }

    abstract public function store():bool;

    abstract public function getStorePath($file = null):string;
}
