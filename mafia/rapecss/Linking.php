<?php
namespace Mafia\RapeCSS;

class Linking extends Soldier
{
    public function store():bool
    {
        $text = $this->html->getElementsByTagName('link');

        foreach ($text as $link) {
            if ($link = $this->isCss($link)) {
                $this->getCSSRecursive($link);
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

    /**
     * @param null $link
     * @return string
     */
    public function getStorePath($link = null):string
    {
        // todo: filter filename
        return $this->getDomain() . '/' . $link;
    }

    /**
     * @param $link
     */
    private function getCSSRecursive($link)
    {
        // var_dump(file_get_contents($link));
    }
}
