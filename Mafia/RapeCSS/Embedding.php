<?php
namespace Mafia\RapeCSS;

use Mafia\Adviser;

class Embedding extends Soldier
{
    function store():bool
    {
        /** @var \DOMNode[] $css */
        $css = $this->html->getElementsByTagName('style');

        foreach ($css as $item) {
            Adviser::storeLinks($this->getStorePath(), $item->textContent);
        }

        return true;
    }

    public function getStorePath($file = null):string
    {
        return $this->getDomain() . '/' . $this->indexCSS;
    }
}
