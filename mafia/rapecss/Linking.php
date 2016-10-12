<?php
namespace Mafia\RapeCSS;

class Linking extends Soldier
{
    public function store():bool
    {
        $text = $this->html->getElementsByTagName('link');

        foreach ($text as $link) {
            if ($link = $this->isCss($link)) {
//                var_dump(file_get_contents($link));
            }
        }

        return true;
    }

    /**
     * @param \DOMElement $link
     * @return bool
     */
    private function isCss(\DOMElement $link)
    {
        $linkUrl = $link->getAttribute('href');

        // todo: more accurate check
        if (strstr($linkUrl, '.css')) {
            return $linkUrl;
        }
        return false;
    }

    public function getStorePath($link = null):string
    {
        // todo: filter filename
        return $link;
    }
}
