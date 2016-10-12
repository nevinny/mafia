<?php
namespace Mafia\RapeCSS;

use Mafia\Adviser;

class Inline extends Soldier
{
    public function store():bool
    {
        /** @var \DOMElement[] $text */
        $text = $this->html->getElementsByTagName('*');

        foreach ($text as $item) {
            if ($style = $this->normalizeStyle($item)) {
                Adviser::storeLinks($this->getStorePath(), $style);
            }
        }

        return true;
    }

    public function getStorePath($file = null):string
    {
        return $this->getDomain() . '/' . $this->indexCSS;
    }

    private function normalizeStyle(\DOMElement $item)
    {
        $style = $item->getAttribute('style');
        if (strlen($style)) {
            $style = 'inline{' . $style;
            if (substr($style, -1) !== ';') {
                $style .= ';';
            }
            $style .= '}';
        }
        return $style;
    }
}
