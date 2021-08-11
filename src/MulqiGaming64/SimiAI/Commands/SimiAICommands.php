<?php
declare(strict_types=1);

namespace MulqiGaming64\SimiAI\Commands;

use MulqiGaming64\SimiAI\SimiAI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class SimiAICommands extends PluginCommand {

	/** @var SimiAI $plugin */
    private $plugin;

    /**
     * SimiAICommands constructor.
     * @param SimiAI $plugin
     */
    public function __construct(SimiAI $plugin) {
		parent::__construct("simiai", $plugin);
		$this->setDescription("SimiAI Commands");
		$this->setAliases(["sai", "ai"]);
        $this->plugin = $plugin;
    }

    /**
     * @param CommandSender $player
     * @param string $commandLabel
     * @param array $args
     * @return mixed|void
     */
    public function execute(CommandSender $player, string $commandLabel, array $args): bool {
		if (!$player instanceof Player) {
            $player->sendMessage("Please Use Commands In Game");
            return false;
		}
		if(isset($args[0])){
			switch($args[0]){
				case "switch":
					if(!$player->hasPermission("simiai.cmd.switch") and !$player->hasPermission("simiai.cmd")) {
						$player->sendMessage(TextFormat::RED . "You Don't Have Permissions");
						return false;
					}
					if($this->plugin->type[strtolower($player->getName())] == "private"){
						$player->sendMessage(TextFormat::GREEN . "Success Change To Public Chat");
						$this->plugin->type[strtolower($player->getName())] = "public";
					} else {
						$player->sendMessage(TextFormat::GREEN . "Success Change To SimiAI Private Chat");
						$this->plugin->type[strtolower($player->getName())] = "private";
					}
				break;
				case "lang":
					if(!$player->hasPermission("simiai.cmd.lang") and !$player->hasPermission("simiai.cmd")) {
						$player->sendMessage(TextFormat::RED . "You Don't Have Permissions");
						return false;
					}
					$this->plugin->sendLangAI($player);
				break;
				case "help":
					if(!$player->hasPermission("simiai.cmd.help") and !$player->hasPermission("simiai.cmd")) {
						$player->sendMessage(TextFormat::RED . "You Don't Have Permissions");
						return false;
					}
					$player->sendMessage(TextFormat::GREEN . "SimiAI Commands:" . TextFormat::EOL . TextFormat::GREEN . "/sai switch" . TextFormat::WHITE . " Change Channel" . TextFormat::EOL . TextFormat::GREEN . "/sai lang" . TextFormat::WHITE . " Change Language AI");
				break;
				default:
					if(!$player->hasPermission("simiai.cmd.help") and !$player->hasPermission("simiai.cmd")) {
						$player->sendMessage(TextFormat::RED . "You Don't Have Permissions");
						return false;
					}
					$player->sendMessage(TextFormat::GREEN . "SimiAI Commands:" . TextFormat::EOL . TextFormat::GREEN . "/sai switch" . TextFormat::WHITE . " Change Channel" . TextFormat::EOL . TextFormat::GREEN . "/sai lang" . TextFormat::WHITE . " Change Language AI");
				break;
			}
		} else {
			if(!$player->hasPermission("simiai.cmd.help") and !$player->hasPermission("simiai.cmd")) {
				$player->sendMessage(TextFormat::RED . "You Don't Have Permissions");
				return false;
			}
			$player->sendMessage(TextFormat::GREEN . "SimiAI Commands:" . TextFormat::EOL . TextFormat::GREEN . "/sai switch" . TextFormat::WHITE . " Change Channel" . TextFormat::EOL . TextFormat::GREEN . "/sai lang" . TextFormat::WHITE . " Change Language AI");
		}
		return true;
    }
}
