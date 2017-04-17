<?php

namespace meta\jamsu;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class JamSuKick extends PluginBase implements Listener{
	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getServer ()->getScheduler ()->scheduleRepeatingTask ( new ClearTask ( $this ), 20 );
	}
	
	public function onMove(PlayerMoveEvent $ev) {
		$this->list[strtolower($ev->getPlayer()->getName())] = strtotime("now");
	}
	
	public $list = [];
	public function checkTick() {
		if (empty($this->list)) return;
		$now = strtotime("now");
		foreach($this->list as $name=>$time) {
			$player = $this->getServer()->getPlayerExact($name);
			if ($player != null) {
				if ($time + 60 >= $now) {
					$player->clost("잠수 킥", "1분간 이동하지 않아서 킥하였습니다.");
					unset($this->list[$name]);
				}
			} else {
				unset($this->list[$name]);
			}
		}
	}
}