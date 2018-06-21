<?php

namespace DustyMC;

use pocketmine\Player;
use pocketmine\item\Item;

class Spieler {

    private $plugin;
    private $prefix = "";

    public function __Construct(Main $plugin){
        $this->plugin = $plugin;
        
        } elseif ($item->getCustomName() == TextFormat::GREEN . "Spieler Sichtbar") {
            $player->getInventory()->remove(Item::get(Item::DYE, 10)->setCustomName(TextFormat::GREEN . "Spieler Sichtbar"));
            $player->getInventory()->addItem(Item::get(Item::DYE, 8)->setCustomName(TextFormat::GRAY . "Spieler unsichtbar"));
            $player->sendMessage($this->prefix . TextFormat::GRAY . "Alle Spieler sind unsichtbar");
            $this->hideall[] = $player;
            foreach ($this->getServer()->getOnlinePlayers() as $p2) {
                $player->hideplayer($p2);
            }
        } elseif ($item->getCustomName() == TextFormat::GRAY . "Spieler unsichtbar") {
            $player->getInventory()->remove(Item::get(Item::DYE, 8)->setCustomName(TextFormat::GRAY . "Spieler unsichtbar"));
            $player->getInventory()->addItem(Item::get(Item::DYE, 10)->setCustomName(TextFormat::GREEN . "Spieler Sichtbar"));
            $player->sendMessage($this->prefix . TextFormat::GREEN . "Alle Spieler Sichtbar");
            unset($this->hideall[array_search($player, $this->hideall)]);
            foreach ($this->getServer()->getOnlinePlayers() as $p2) {
                $player->showplayer($p2);               
            }
        }
    }