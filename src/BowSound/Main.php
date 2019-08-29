<?php
namespace BowSound;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\entity\ProjectileHitEntityEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onProjectileHit(ProjectileHitEvent $event){
        $projectile = $event->getEntity();
        $entity = $projectile->getOwningEntity();
        if($entity instanceof Player && $event instanceof ProjectileHitEntityEvent){
            $target = $event->getEntityHit();
            if($target instanceof Player){
                $pk = new PlaySoundPacket();
                $pk->x = $entity->getX();
                $pk->y = $entity->getY();
                $pk->z = $entity->getZ();
                $pk->volume = 1;
                $pk->pitch = 1;
                $pk->soundName = 'random.toast';
                $entity->dataPacket($pk);
            }
        }
    }
}