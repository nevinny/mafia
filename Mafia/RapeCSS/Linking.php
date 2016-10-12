<?php
namespace Mafia\RapeCSS;

use Mafia\Adviser;

class Linking extends Soldier
{
    public function store():bool
    {
        $text = $this->html->getElementsByTagName('link');

        foreach ($text as $link) {
            if ($link = $this->isCss($link)) {
                $style = $this->getCSSRecursive($link);
                Adviser::storeLinks($this->getStorePath(), $style);
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
        if ($link) {
            // todo: filter filename
            $url = parse_url($link);
            $file = $url['path'];
            $file = str_replace('/', '_', $file);
            return $this->getDomain() . '/' . $file;
        }
        return $this->getDomain() . '/' . $this->indexCSS;
    }

    /**
     * @param $link
     * @return string
     */
    private function getCSSRecursive($link)
    {
        $link = preg_replace('/^\/\//','http://', $link);
        return file_get_contents($link);
    }
}
