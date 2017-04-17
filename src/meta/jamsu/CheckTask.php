<?php
namespace meta\jamsu;

use pocketmine\scheduler\Task;

class CheckTask extends Task {
	private $owner;
	public function __construct(JamSuKick $owner) {
		$this->owner = $owner;
	}
	public function onRun($currentTick) {
		$this->owner->checkTick ();
	}
}
?>
