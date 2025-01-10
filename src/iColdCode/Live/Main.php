<?php

namespace iColdCode\Live;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    public function onEnable(): void {
        $this->getLogger()->info(TextFormat::GREEN . "┏┓
┃┃
┃┃╋╋┏┳┓┏┳━━┓
┃┃╋┏╋┫┗┛┃┃━┫
┃┗━┛┃┣┓┏┫┃━┫
┗━━━┻┛┗┛┗━━┛
The plugin is working
Live v0.0.1 by iColdCode

Please report bugs and check for updates on my github
https://github.com/icoldcode

Community
https://discord.gg/sagemc");
    }

    public function onDisable(): void {
        $this->getLogger()->info(TextFormat::RED . "┏┓
┃┃
┃┃╋╋┏┳┓┏┳━━┓
┃┃╋┏╋┫┗┛┃┃━┫
┃┗━┛┃┣┓┏┫┃━┫
┗━━━┻┛┗┛┗━━┛
The plugin is no longer working because the server was shut down
Live v0.0.1 by iColdCode

Please report bugs and check for updates on my github
https://github.com/icoldcode

Community
https://discord.gg/sagemc");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if ($command->getName() === "live") {
            if (!$sender instanceof Player) {
                $sender->sendMessage(TextFormat::RED . "This command can only be used by players, not from the console.");
                return true;
            }

            if (!$sender->hasPermission("live.use")) {
                $sender->sendMessage(TextFormat::RED . "You do not have the permissions for this command.");
                return true;
            }

            if (count($args) !== 1) {
                $sender->sendMessage(TextFormat::YELLOW . "Correct use: /live <link>");
                return true;
            }

            $link = $args[0];

            if (!filter_var($link, FILTER_VALIDATE_URL)) {
                $sender->sendMessage(TextFormat::RED . "Please enter a valid live link.");
                return true;
            }

            $message = TextFormat::GREEN . "¡" . $sender->getName() . " está en vivo! Mira el stream aquí: " . TextFormat::AQUA . $link;
            $this->getServer()->broadcastMessage($message);
            return true;
        }

        return false;
    }
}
