<?php

declare(strict_types=1);

namespace MulqiGaming64\SimiAI;

use MulqiGaming64\SimiAI\Commands\SimiAICommands;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerQuitEvent;

use pocketmine\event\player\PlayerLoginEvent;

use pocketmine\event\player\PlayerChatEvent;

use pocketmine\plugin\PluginBase;

use pocketmine\Server;

use pocketmine\Player;

use pocketmine\utils\Config;

use pocketmine\utils\TextFormat;

use EasyUI\EasyUI;

use MulqiGaming64\SimiAI\Form\LangAI;

class SimiAI extends PluginBase implements Listener{

	const SIMI_API_URL = "https://mulqigaming.herokuapp.com/simi/";	

	/** @var SimiAI $instance */

    private static $instance;

    
    /**
    * @var array
    * @return array
    */
    public $type = [];

    /** @var PureChat */
    private $purechat;

    /**
    * @var array
    * @return array
    */
    public $lang = [];

    

    public function onEnable(){

    	@mkdir($this->getDataFolder());

        $this->saveResource("config.yml");

        $this->saveResource("lang.yml");

        $this->checkExtensions();

		$this->checkDepends();

		$this->config = (new Config($this->getDataFolder() . "config.yml", Config::YAML))->getAll();

		$this->lang = yaml_parse(file_get_contents($this->getDataFolder() . "lang.yml"));

		$this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->getServer()->getCommandMap()->register("SimiAI", new SimiAICommands($this));

		self::$instance = $this;

    }

    

    public function onDisable(){

        file_put_contents($this->getDataFolder() . "lang.yml", yaml_emit($this->lang));

        $this->getLogger()->warning("Saving Language Settings For Player, Please Wait...");

        sleep(3);

    }

    

    private function checkExtensions(){

    	if (!extension_loaded("curl")){

            $this->getLogger()->warning("Curl Extensions Not Detected, Please Install To Avoid Errors!");

        }

        $curlver = curl_version();

        $ssl = ($curlver['features'] & CURL_VERSION_SSL);

        if (!$ssl){

            $this->getLogger()->warning("Curl Ssl Extensions Not Detected, Please Install To Avoid Errors!");

        }

    }

    

    private function checkDepends(){

    	$this->purechat = $this->getServer()->getPluginManager()->getPlugin("PureChat");

		if(is_null($this->purechat)){

			$this->getLogger()->warning("PureChat Depends Not Detected, Using SimiAI Player Chat");

		} else {

			$this->getLogger()->warning("PureChat Depends Detected, Using SimiAI Player PureChat");

		}

		if(!class_exists(EasyUI::class)){

			$this->getLogger()->warning("EasyUI Depends Not Detected, Please Install To Avoid Errors!");

         }

    }

    

    public static function getInstance(): SimiAI {

        return self::$instance;

    }

    

    public function onLogin(PlayerLoginEvent $event){

    	$player = $event->getPlayer();

    	$name = strtolower($player->getName());

    	if(!isset($this->type[$name])){

    		$this->type[$name] = "public";

    	}

 	   if(!isset($this->lang["lang"][$name])){

    		$this->lang["lang"][$name] = "en";

    	}

    }

    

    public function onQuit(PlayerQuitEvent $event){

    	$player = $event->getPlayer();

    	$name = strtolower($player->getName());

    	if(isset($this->type[$name])){

    		unset($this->type[$name]);

    	}

    }

    

	/**
     * @param PlayerChatEvent $event
     * @priority HIGHEST
     */

	public function onChat(PlayerChatEvent $event){

		if ($event->isCancelled()) return;

		$player = $event->getPlayer();

    	$name = strtolower($player->getName());

        $message = $event->getMessage();

        if (!isset($message) || $message == "") return;

        if(is_null($this->purechat)){

    		$format = str_replace(["{NAME}", "{PREFIX}", "{MSG}"], [$name, $this->config["prefix"], $message], $this->config["player-chat"]);

    	} else {

    		$format = $this->purechat->getChatFormat($player, $message);

    	}

    	//Log Message

		$this->getLogger()->info($format);

    	if($this->type[strtolower($player->getName())] == "private"){

    		$player->sendMessage($format);

			$player->sendMessage(str_replace(["{PREFIX}", "{MSG}"], [$this->config["prefix"], $this->simiChat($message, $this->getLangAI($player), $this->config["timeout"])], $this->config["simi-chat"]));

    		$event->setCancelled(true);

    		return;

    	}

        foreach ($this->getServer()->getOnlinePlayers() as $allplayer) {

        	if($this->type[strtolower($allplayer->getName())] == "public"){

        		$allplayer->sendMessage($format);

        		$event->setCancelled(true);

        	}

		}

	}

	

	public function simiChat(string $text, string $lang, int $timeout): void{

        $ctx = $this->initializeAI($text, $lang, $timeout);

        $body = curl_exec($ctx);

        if ($body === false) {

            $err = curl_error($ctx);

            curl_close($ctx);

			$this->getLogger()->warning(TextFormat::RED . "Error When Get Data, Error: " . $err);

			return "Sorry, Can You Say One More Time?";

        }

        curl_close($ctx);

        $result = json_decode($body, true);

        if($result["status"] == "failed"){

        	$this->getLogger()->warning(TextFormat::RED . "Error When Get Data, Error: " . $result["result"]);

        	return "Sorry, there was an error in the system";

        }

        return $result["result"];

    }

    

    private function initializeAI($text, $lang, $timeout): void{

        $ctx = curl_init(self::SIMI_API_URL . "?apikey=poggitsimi&text=" . urlencode($text) . "&lang=" . $lang);

        curl_setopt($ctx, CURLOPT_HTTPHEADER, ["User-Agent: MulqiGaming64"]);

        curl_setopt($ctx, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ctx, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ctx, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ctx, CURLOPT_FOLLOWLOCATION, false);
        return $ctx;
    }

    public function getLangAI($player): void{
    	if($player instanceof Player){
			$player = $player->getName();
		}
		$player = strtolower($player);
		return $this->lang["lang"][$player];

	}
	
	public function sendLangAI(Player $player): void{
		$player->sendForm(new LangAI($this));
	}
}
