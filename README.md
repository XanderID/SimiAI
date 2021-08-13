<h1>SimiAI<img src="https://github.com/MulqiGaming64/SimiAI/blob/main/images/image.png" height="64" width="64" align="left"></h1><br>
SimiAI by MulqiGaming64 is a PocketMine-MP Plugin To Allow Players To Talk With AI (Simi)

# Language

List of languages that can be used by SimiAI 
ISO 3166-1| Country
--- | ---
`ar` | Arab
`ch` | Chamorro
`de` | German
`es` | Spanish
`fr` | Francis
`en` | English
`id` | Indonesia
`ja` | Japan
`ko` | Korea
`ph` | Philippines
`pt` | Portuguese
`ru` | Russia
`vi` | Vietnamese
`zh` | Chinese

# Commands

Command | Description | Permission
--- | --- | ---
`/simiai <SubCommands>` | SimiAI Commands | simiai.cmd

# SubCommands

SubCommand | Description | Permission
--- | --- | ---
`switch` | Change Chat Channel | simiai.cmd.switch
`lang` | Change AI Language | simiai.cmd.lang
`help` | List Commands | simiai.cmd.help

# Config

``` YAML

# Prefix Settings
prefix: "[§aSimiAI§r]"

# Tag
# {MSG} Message SimiAI
# {PREFIX} Prefix
# {NAME}

# SimiAI Chat Settings
simi-chat: "{PREFIX} §a{MSG}"

# Player Chat Settings
# If you not using PureChat
player-chat: "{NAME} > {MSG}"

# SimiAI Timeout Request
timeout: 500

# SimiAI Save Lang Interval
auto-save: 10
```

## SimiAI Api
- You Can add SimiAI Chat to your plugins
**Examples:**

```php
<?php  
  
declare(strict_types=1);  
  
namespace xyz;  
  
use MulqiGaming64\SimiAI\SimiAI;  
use pocketmine\command\Command;  
use pocketmine\command\CommandSender;  
use pocketmine\event\Listener;  
use pocketmine\plugin\PluginBase;  
  
/**  
 * Class XYZPlugin
 * @package xyz  
 */
class XYZPlugin extends PluginBase implements Listener {
 
  
  public function onEnable() {  
    $this->getServer()->getPluginManager()->registerEvents($this, $this);  
  }
    
  /**  
    * @param CommandSender $sender  
    * @param Command $command  
    * @param string $label  
    * @param array $args
    *   
    * @return bool  
    */
   public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
     if($command->getName() == "xyz") {
       $sender->sendMessage(SimiAI::getInstance()->simiChat($args[0], "en", 500));
     }
     return true;
   }  
}  
```

## 📸 Screenshot

<img src="https://github.com/MulqiGaming64/SimiAI/blob/main/images/screenshot.png">
<img src="https://github.com/MulqiGaming64/SimiAI/blob/main/images/screenshot2.png">

## Todo List
- Add SimiAI Chat Event

# Additional Notes

- If you find bugs or want to give suggestions, please visit [here](https://github.com/MulqiGaming64/SimiAI/issues)
- Icons made by <a href="https://commons.m.wikimedia.org/">commons.m.wikimedia.org</a>
