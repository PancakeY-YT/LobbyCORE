<?php

namespace DustyMC;

use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat as TF;

use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\InvMenu;

class Navigator {

    private $plugin;
    private $prefix = "";

    public function __Construct(Main $plugin){
        $this->plugin = $plugin;
        
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($plugin);
        }

    }

    public function Navigator(Player $player)
    {
        $menu = InvMenu::create(InvMenu::TYPE_CHEST);
        
        $menu->readonly();
        $menu->setName("§9Syntoxien §7- §aNavigator");
        
        $spawn = Item::get(378, 0, 1);
        $spawn->setCustomName(TF::RESET . TF::YELLOW . "Spawn");
        $spawn->setLore([
        	'',
        	'§r§7» §eTeleportiert dich zum Spawn von der Lobby',
        	''
        ]);
        
        $sw = Item::get(2, 0, 1);
        $sw->setCustomName(TF::RESET . TF::YELLOW . "SkyWars");
        $sw->setLore([
        	 '',
        	 '§r§7» §eStatus',
             '§r§7• §4Offline',
        	 ''
         ]); 
        
        $ffa = Item::get(276, 0, 1);
        $ffa->setCustomName(TF::RESET . TF::YELLOW . "PvP");
        $ffa->setLore([
        	 '',
        	 '§r§7» §eStatus',
             '§r§7• §4Offline',
        	 ''
         ]);        
        
        $axe = Item::get(258, 0, 1);
        $axe->setCustomName(TF::RESET . TF:: YELLOW . "CityBuild");
        $axe->setLore([
        	 '',
        	 '§r§7» §eStatus',
             '§r§7• §4Offline',
        	 ''
         ]);  
        
	 $soon = Item::get(351, 1, 1);
        $soon->setCustomName(TF::RESET . TF::DARK_RED . "Coming Soon");
        
       $chest = Item::get(54, 0, 1);
        $chest->setCustomName(TF::RESET . TF::GREEN . "ChestOpening");
	 
	$air1 = Item::get(160, 0, 1);
       $air1->setCustomName("");
	
	$air = Item::get(160, 15, 1);
       $air->setCustomName("");

        $inv = $menu->getInventory();
        
     $inv->setItem(0, $air);
	 $inv->setItem(1, $sw);
	 $inv->setItem(2, $air);
	 $inv->setItem(3, $air1);
	 $inv->setItem(4, $air);
	 $inv->setItem(5, $air1);
	 $inv->setItem(6, $air);
	 $inv->setItem(7, $chest);
	 $inv->setItem(8, $air);
	 
	 $inv->setItem(9, $ffa);
     $inv->setItem(10, $air);
     $inv->setItem(11, $air1);
     $inv->setItem(12, $air);
     $inv->setItem(13, $spawn);
     $inv->setItem(14, $air);
     $inv->setItem(15, $air1);
     $inv->setItem(16, $air);
     $inv->setItem(17, $axe);
        
	 $inv->setItem(18, $air);
	 $inv->setItem(19, $soon);
	 $inv->setItem(20, $air);
	 $inv->setItem(21, $air1);
	 $inv->setItem(22, $air);
	 $inv->setItem(23, $air1);
	 $inv->setItem(24, $air);
	 $inv->setItem(25, $soon);
	 $inv->setItem(26, $air);
	 
	 /*$inv->setItem(0, $air);
	 $inv->setItem(1, $air1);
	 $inv->setItem(2, $air);
	 $inv->setItem(3, $air1);
	 $inv->setItem(4, $spawn);
	 $inv->setItem(5, $air1);
	 $inv->setItem(6, $air);
	 $inv->setItem(7, $air1);
	 $inv->setItem(8, $air);
	 
	 $inv->setItem(9, $air1);
        $inv->setItem(10, $air);
        $inv->setItem(11, $air1);
        $inv->setItem(12, $air);
        $inv->setItem(13, $air1);
        $inv->setItem(14, $air);
        $inv->setItem(15, $air1);
        $inv->setItem(16, $air);
        $inv->setItem(17, $air1);
        
	 $inv->setItem(18, $air);
	 $inv->setItem(19, $sw);
	 $inv->setItem(20, $air);
	 $inv->setItem(21, $ffa);
	 $inv->setItem(22, $air);
	 $inv->setItem(23, $mc);
	 $inv->setItem(24, $air);
	 $inv->setItem(25, $qsg);
	 $inv->setItem(26, $air);
	 
	 $inv->setItem(27, $air1);
        $inv->setItem(28, $air);
        $inv->setItem(29, $air1);
        $inv->setItem(30, $air);
        $inv->setItem(31, $air1);
        $inv->setItem(32, $air);
        $inv->setItem(33, $air1);
        $inv->setItem(34, $air);
        $inv->setItem(35, $air1);
        
        $inv->setItem(36, $air);
	 $inv->setItem(37, $lbb);
	 $inv->setItem(38, $air);
	 $inv->setItem(39, $axe);
	 $inv->setItem(40, $air);
	 $inv->setItem(41, $join);
	 $inv->setItem(42, $air);
	 $inv->setItem(43, $soon);
	 $inv->setItem(44, $air);
	 
	 $inv->setItem(45, $air1);
        $inv->setItem(46, $air);
        $inv->setItem(47, $air1);
        $inv->setItem(48, $air);
        $inv->setItem(49, $air1);
        $inv->setItem(50, $air);
        $inv->setItem(51, $air1);
        $inv->setItem(52, $air);
        $inv->setItem(53, $air1);*/
        
        $menu->setListener([$this, "onTransaction"]);
        $menu->setListener(function(player $player, item $itemClickedOn, Item $itemClickedwith): bool{
            $name = $player->getName();
            
            if($itemClickedOn->getCustomName() == TF::RESET . TF::YELLOW . "SkyWars"){
            
            	$player->transfer("82.211.44.7", "19132");
            	
            }
           
           if($itemClickedOn->getCustomName() == TF::RESET . TF::YELLOW . "PvP"){
            
            	$player->transfer("82.211.44.7", "19132"); 
            
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
