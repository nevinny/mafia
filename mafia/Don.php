<?php
namespace Mafia;

use Mafia\RapeCSS\Capo;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class Don
 * Глава семьи.
 * Получает сведения о любом «деле», совершаемом каждым членом семьи.
 * Дон избирается голосованием капо.
 * В случае равенства количества голосов проголосовать также должен подручный Дона.
 * До 1950-х годов в голосовании участвовали вообще все члены семьи,
 * но впоследствии от этой практики отказались,
 * поскольку она привлекала внимание правоохранительных органов.
 */
class Don
{
    public function __construct(Adviser $adviser)
    {
        $output = new ConsoleOutput();
        $count = count($adviser->getLinks());
        $progress = new ProgressBar($output, $count);

        $progress->start();
        foreach ($adviser->getLinks() as $link) {
            $link = trim($link);
            new Capo($link);
            $progress->advance();
        }
        $progress->finish();
    }
}