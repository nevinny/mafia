<?php

include 'vendor/autoload.php';
use Mafia\Don;
use Mafia\Adviser;

Adviser::clearCorpses(Adviser::CORPSES);
$adviser = new Adviser();

$under = new \Mafia\UnderBoss();

$don = new Don($adviser->getLinks());
