<?php

namespace DustyMC;

use pocketmine\Player;
use pocketmine\item\Item;
use pocketmine\event\Listeners;
use pocketmine\scheduler\Task;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\utils\TextFormat as c;
use DustyMC\Main;

class Hider implements Listener {

     public $vip = [];
     public $none = [];    
     
     public function __Construct(Main $plugin){
     
        $this->plugin = $plugin;
        $this->plugin->getScheduler()->scheduleRepeatingTask($this, 10);
    }

    public function getItems(Player $player)
     {
        if ($this->plugin instanceof PlayerHider) {
            $inv = $player->getInventory();
            $name = $player->getName();
            $estick = Enchantment::getEnchantment((int) Enchantment::PROTECTION);

            $inv->clearAll();
            if (in_array($name, $this->plugin->vip)) {
                $all = Item::get(351, 10, 1);
                $all->setCustomName(c::RESET . c::GREEN . "Alle Spieler sichtbar");

                $vip = Item::get(351, 5, 1);
                $vip->setCustomName(c::RESET . c::DARK_PURPLE . "Nur VIPs sichtbar");
                $vip->addEnchantment(new EnchantmentInstance($estick, 1));

                $item = Item::get(351, 8, 1);
                $item->setCustomName(c::RESET . c::GRAY . "Keine Spieler sichtbar");

                $inv->setItem(2, $all);

                $inv->setItem(6, $item);

                $inv->setItem(4, $vip);
            } elseif (in_array($name, $this->plugin->none)) {
                $all = Item::get(351, 10, 1);
                $all->setCustomName(c::RESET . c::GREEN . "Alle Spieler sichtbar");

                $vip = Item::get(351, 5, 1);
                $vip->setCustomName(c::RESET . c::DARK_PURPLE . "Nur VIPs sichtbar");

                $item = Item::get(351, 8, 1);
                $item->setCustomName(c::RESET . c::GRAY . "Keine Spieler sichtbar");
                $item->addEnchantment(new EnchantmentInstance($estick, 1));

                $inv->setItem(2, $all);

                $inv->setItem(6, $item);

                $inv->setItem(4, $vip);
            }else {
                $all = Item::get(351, 10, 1);
                $all->setCustomName(c::RESET . c::GREEN . "Alle Spieler sichtbar");
                $all->addEnchantment(new EnchantmentInstance($estick, 1));

                $vip = Item::get(351, 5, 1);
                $vip->setCustomName(c::RESET . c::DARK_PURPLE . "Nur VIPs sichtbar");

                $item = Item::get(351, 8, 1);
                $item->setCustomName(c::RESET . c::GRAY . "Keine Spieler sichtbar");

                $inv->setItem(2, $all);

                $inv->setItem(6, $item);

                $inv->setItem(4, $vip);
            }

            $exit = Item::get(351, 1, 1);
            $exit->setCustomName(c::RESET . c::RED . "Exit");

            $inv->setItem(8, $exit);
            
            }
            
            public function onClick(PlayerInteractEvent $event)
    {
        $player = $event->getPlayer();
        $name = $player->getName();
        $in = $event->getPlayer()->getInventory()->getItemInHand()->getCustomName();
        $Hider = new openHider($this->plugin);

        if ($in == c::RESET . c::GREEN . "Alle Spieler sichtbar") {

            if (in_array($name, $this->plugin->vip)) {
                unset($this->plugin->vip[array_search($name, $this->plugin->vip)]);
            }
            if (in_array($name, $this->plugin->none)) {
                unset($this->plugin->none[array_search($name, $this->plugin->none)]);
            }
            $Hider->getItems($player);
        }

        if ($in == c::RESET . c::DARK_PURPLE . "Nur VIPs sichtbar") {
            if (in_array($name, $this->plugin->vip)) {
                unset($this->plugin->vip[array_search($name, $this->plugin->vip)]);
            }
            if (in_array($name, $this->plugin->none)) {
                unset($this->plugin->none[array_search($name, $this->plugin->none)]);
            }
            $this->plugin->vip[] = $name;
            $Hider->getItems($player);
        }

        if ($in == c::RESET . c::GRAY . "Keine Spieler sichtbar") {
            if (in_array($name, $this->plugin->vip)) {
                unset($this->plugin->vip[array_search($name, $this->plugin->vip)]);
            }
            if (in_array($name, $this->plugin->none)) {
                unset($this->plugin->none[array_search($name, $this->plugin->none)]);
            }
            $this->plugin->none[] = $name;
            $Hider->getItems($player);
            
            }
            
            public function onRun(int $currentTick)
    {
        if ($this->plugin instanceof PlayerHider) {
            foreach ($this->plugin->getServer()->getOnlinePlayers() as $player) {

                $name = $player->getName();
                $inv = $player->getInventory()->getItemInHand()->getCustomName();

                $players = $player->getLevel()->getPlayers();

                foreach($players as $play) {
                    if (in_array($name, $this->plugin->vip)) {
                        if ($play->hasPermission("hider.vip") or $play->isOp()) {
                            $player->showPlayer($play);
                        } else {
                            $player->hidePlayer($play);
                        }
                    } elseif (in_array($name, $this->plugin->none)) {
                        $player->hidePlayer($play);
                    }else {
                        $player->showPlayer($play);
                    }
                }
            }
        }
    }
}