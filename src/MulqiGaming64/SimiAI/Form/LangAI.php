<?php

namespace MulqiGaming64\SimiAI\Form;

use MulqiGaming64\SimiAI\SimiAI;

use EasyUI\element\Button;

use EasyUI\icon\ButtonIcon;

use EasyUI\variant\SimpleForm;

use pocketmine\Player;

use pocketmine\utils\TextFormat;

class LangAI extends SimpleForm{

	public function __construct(SimiAI $plugin) {        $this->plugin = $plugin;

        parent::__construct("Language", "Change Your AI Language Here");

    }

    protected function onCreation(): void {

    	$this->addCloseButton();

        $this->addLanguageButton();

    }

    

    public function addLanguageButton(): void {

        $this->addButton(new Button("English", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "en";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to English");

        }));

        $this->addButton(new Button("Vietnamese", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "vi";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Vietnamese");

        }));

        $this->addButton(new Button("Philippines", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "ph";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Philippines");

        }));

        $this->addButton(new Button("Indonesia", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "id";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Indonesia");

        }));

        $this->addButton(new Button("Chinese", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "zh";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Chinese");

        }));

        $this->addButton(new Button("Chamorro", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "ch";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Chamorro");

        }));

        $this->addButton(new Button("Russia", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "ru";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Russia");

        }));

        $this->addButton(new Button("Korea", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "ko";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Korea");

        }));

        $this->addButton(new Button("Arab", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "ar";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Arab");

        }));

        $this->addButton(new Button("Francis", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "fr";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Francis");

        }));

        $this->addButton(new Button("Japan", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "ja";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Japan");

        }));

        $this->addButton(new Button("Spanish", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "es";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Spanish");

        }));

        $this->addButton(new Button("German", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "de";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to German");

        }));

        $this->addButton(new Button("Portuguese", null, function(Player $player) {

            $this->plugin->lang["lang"][strtolower($player->getName())] = "pt";

            $player->sendMessage(TextFormat::GREEN . "successfully changed the language SimiAI to Portuguese");

        }));

    }

    

    public function addCloseButton(): void {

        $this->addButton(new Button("Close", new ButtonIcon("textures/blocks/barrier", ButtonIcon::TYPE_PATH), function(Player $player) {

            return;

        }));

    }

}
