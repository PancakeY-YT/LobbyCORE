<?php

namespace DustyMC;

use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\InvMenu;

class Lobbys {

    private $plugin;
    private $prefix = "";

    public function __Construct(Main $plugin){
        $this->plugin = $plugin;
        
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($plugin);
        }

    }

    public function Lobbys(Player $player)
    {
        $menu = InvMenu::create(InvMenu::TYPE_CHEST);
        
        $menu->readonly();
        $menu->setName(TF::GRAY . "» " . TF::GREEN . "Lobbys" . TF::GRAY . " «");

        $lobby1 = Item::get(351, 10, 1);
        $lobby1->setCustomName(TF::RESET . TF::BLUE . "Lobby-1");
        $lobby1->setLore([
        	'',
        	'§r§7» §eStatus',
        	'§r§7• §aOnline',
        	''
        ]);
        
        $lobby2 = Item::get(351, 10, 1);
        $lobby2->setCustomName(TF::RESET . TF::BLUE . "Lobby-2");
        $lobby2->setLore([
        	'',
        	'§r§7» §eStatus',
        	'§r§7• §aOnline',
        	''
        ]);
        
        $lobby3 = Item::get(351, 1, 1);
        $lobby3->setCustomName(TF::RESET . TF::BLUE . "Lobby-3");
        $lobby3->setLore([
        	'',
        	'§r§7» §eStatus',
        	'§r§7• §4Offline',
        	''
        ]);
        
        $lobby4 = Item::get(351, 1, 1);
        $lobby4->setCustomName(TF::RESET . TF::BLUE . "Lobby-4");
        $lobby4->setLore([
        	'',
        	'§r§7» §eStatus',
        	'§r§7• §4Offline',
        	''
        ]);
	 
	 $lobby5 = Item::get(351, 5, 1);
    $lobby5->setCustomName(TF::RESET . TF::DARK_PURPLE . "VIP Lobby");
	 $lobby5->setLore([
        	'',
        	'§r§7» §eStatus',
        	'§r§7• §4Noch nicht Verfügbar',
        	''
        ]);

	$air = Item::get(160, 0, 1);
       $air->setCustomName("");
	
	$air1 = Item::get(160, 15, 1);
       $air1->setCustomName("");

        $inv = $menu->getInventory();
        
	 $inv->setItem(0, $air);
	 $inv->setItem(1, $air1);
	 $inv->setItem(2, $air);
	 $inv->setItem(3, $air1);
	 $inv->setItem(4, $lobby5);
	 $inv->setItem(5, $air1);
	 $inv->setItem(6, $air);
	 $inv->setItem(7, $air1);
	 $inv->setItem(8, $air);
	 
	 $inv->setItem(9, $air1);
        $inv->setItem(10, $lobby1);
        $inv->setItem(11, $air1);
        $inv->setItem(12, $lobby2);
        $inv->setItem(13, $air1);
        $inv->setItem(14, $lobby3);
        $inv->setItem(15, $air1);
        $inv->setItem(16, $lobby4);
        $inv->setItem(17, $air1);
        
	 $inv->setItem(18, $air);
	 $inv->setItem(19, $air1);
	 $inv->setItem(20, $air);
	 $inv->setItem(21, $air1);
	 $inv->setItem(22, $air);
	 $inv->setItem(23, $air1);
	 $inv->setItem(24, $air);
	 $inv->setItem(25, $air1);
	 $inv->setItem(26, $air);
	 
        $menu->setListener([$this, "onTransaction"]);
        $menu->setListener(function(player $player, item $itemClickedOn, Item $itemClickedwith): bool{
            $name = $player->getName();
            
            if($itemClickedOn->getCustomName() == TF::RESET . TF::BLUE . "Lobby-1"){
            
              $player->sendMessage(TF::GREEN."Du bist bereits in Lobby-1!");
            	
            }

            if($itemClickedOn->getCustomName() == TF::RESET . TF::BLUE . "Lobby-2"){
            
              $player->sendMessage(TF::GREEN."Du wirst nun zu Lobby-2 transferiert!");
              $player->transfer("145.239.47.187", "19133");
              
            }

            if($itemClickedOn->getCustomName() == TF::RESET . TF::BLUE . "Lobby-3"){
            
              $player->sendMessage(TF::DARK_RED."Kommt Bald..."); 	

            }

            if($itemClickedOn->getCustomName() == TF::RESET . TF::BLUE . "Lobby-4"){
            
              $player->sendMessage(TF::DARK_RED."Kommt Bald...");

            }
            
            if($itemClickedOn->getCustomName() == TF::RESET . TF::DARK_PURPLE . "VIP Lobby"){
            
              $player->sendMessage(TF::DARK_RED."Du benötigst einen höheren Rang als Spieler!"); 
              
            }
         
            return true;
        });

        $menu->send($player);
    }
    
    public function onTransaction(Player $player, Item $itemTakenOut, Item $itemPutIn, SlotChangeAction $inventoryAction) : bool{

        $player->removeWindow($inventoryAction->getInventory());

        return true;
    }
}
