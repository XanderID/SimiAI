<?php

namespace MulqiGaming64\SimiAI\Task;

use MulqiGaming64\SimiAI\SimiAI;
use pocketmine\scheduler\Task;

class SaveLangTask extends Task {
	
    private $plugin;
    
	public function __construct(SimiAI $plugin){
		$this->plugin = $plugin;
	}

	public function onRun(int $currentTick){
		$this->plugin->saveLangPlayer();
	}
}
