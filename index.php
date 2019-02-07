<?php
/**
 * Created by PhpStorm.
 * User: mh96
 * Date: 26.01.2019
 * Time: 20:56
 */

require_once "./vendor/autoload.php";

$loader = new Twig_Loader_Filesystem("./templates");
$twig = new Twig_Environment($loader);

$template = $twig->load('overview.twig');


class ChessPiece
{

    static $RACE_BEAST = 'Beast';
    static $RACE_DEMON = 'Demon';
    static $RACE_DRAGON = 'Dragon';
    static $RACE_DWARF = 'Dwarf';
    static $RACE_ELEMENT = 'Element';
    static $RACE_ELF = 'Elf';
    static $RACE_GOBLIN = 'Goblin';
    static $RACE_HUMAN = 'Human';
    static $RACE_NAGA = 'Naga';
    static $RACE_OGRE = 'Ogre';
    static $RACE_ORC = 'Orc';
    static $RACE_TROLL = 'Troll';
    static $RACE_UNDEAD = 'Undead';

    static $RACES = array(
        'Beast',
        'Demon',
        'Dragon',
        'Dwarf',
        'Element',
        'Elf',
        'Goblin',
        'Human',
        'Naga',
        'Ogre',
        'Orc',
        'Troll',
        'Undead',
    );

    static $CLASS_ASSASSIN = 'Assassin';
    static $CLASS_DEMON_HUNTER = 'Demon Hunter';
    static $CLASS_DRUID = 'Druid';
    static $CLASS_HUNTER = 'Hunter';
    static $CLASS_KNIGHT = 'Knight';
    static $CLASS_MAGE = 'Mage';
    static $CLASS_MECH = 'Mech';
    static $CLASS_SHAMAN = 'Shaman';
    static $CLASS_WARLOCK = 'Warlock';
    static $CLASS_WARRIOR = 'Warrior';

    static $CLASSES = array(
        'Assassin',
        'Demon Hunter',
        'Druid',
        'Hunter',
        'Knight',
        'Mage',
        'Mech',
        'Shaman',
        'Warlock',
        'Warrior',
    );

    static $RARITY_COMMON = 'Common';
    static $RARITY_UNCOMMON = 'Uncommon';
    static $RARITY_RARE = 'Rare';
    static $RARITY_EPIC = 'Epic';
    static $RARITY_LEGENDARY = 'Legendary';

    static $RARITIES = array(
        'Common',
        'Uncommon',
        'Rare',
        'Epic',
        'Legendary',
    );

    static $RACE_BONUS = array(
        'Beast' => array(
            2 => 'Attack damage increased by 10% for all allies.',
            4 => 'Attack damage increased by 15% for all allies.',
            6 => 'Attack damage increased by 20% for all allies.',
        ),
        'Demon' => array(
            1 => 'Deal 50% extra pure damage to its target.',
        ),
        'Dragon' => array(
            3 => 'All friendly dragons have 100 mana when battle starts.',
        ),
        'Dwarf' => array(
            2 => 'Attack range increased by 300.',
        ),
        'Element' => array(
            2 => '30% chance to turn attacker into stone for 3s when attacked by melee chesses.',
        ),
        'Elf' => array(
            3 => 'Evasion increased by 25% for all friendly elves.',
            6 => 'Evasion increased by 25% for all friendly elves.',
        ),
        'Goblin' => array(
            3 => 'Armor and HP regeneration increased by 15 for a random ally.',
            6 => 'Armor and HP regeneration increased by 15 for all friendly goblins.',
        ),
        'Human' => array(
            2 => 'All friendly humans have 20% chance to disarm target for 3s on damage deal.',
            4 => 'All friendly humans have 25% chance to disarm target for 3s on damage deal.',
            6 => 'All friendly humans have 30% chance to disarm target for 3s on damage deal.',
        ),
        'Naga' => array(
            2 => 'Magic resistance increased by 20 for all allies.',
            4 => 'Magic resistance increased by 40 for all allies.',
        ),
        'Orge' => array(
            1 => 'Max hp increased by 10%.',
        ),
        'Orc' => array(
            2 => 'Max HP increased by 250 for all friendly orcs.',
            4 => 'Max HP increased by 350 for all friendly orcs.',
        ),
        'Troll' => array(
            2 => 'Attack speed increased by 35 for all friendly trolls.',
            4 => 'Attack speed increased by 35 for all friendly.',
        ),
        'Undead' => array(
            2 => 'Armor decreased by 5 for all enemies.',
            4 => 'Armor decreased by 7 for all enemies.',
        ),
    );

    static $CLASS_BONUS = array(
        'Assassin' => array(
            3 => 'All friendly assassins have 10% chance to deal 4x damage.',
            6 => 'All friendly assassins have 20% chance to deal 4x damage.',
        ),
        'Demon Hunter' => array(
            0 => 'Considered as an enemy demon',
        ),
        'Druid' => array(
            0 => 'Two &ensp;&#9733;&ensp; druids can upgrade to a &ensp;&#9733;&#9733;&ensp; druid.<br/>Two &ensp;&#9733;&#9733;&ensp; druids can upgrade to a &ensp;&#9733;&#9733;&#9733;&ensp; druid.',
        ),
        'Hunter' => array(
            3 => 'Attack damage increased by 25% for all friendly hunters.',
            6 => 'Attack damage increased by 35% for all friendly hunters.',
        ),
        'Knight' => array(
            2 => 'All friendly knights have 25% chance to get a shield.',
            4 => 'All friendly knights have 35% chance to get a shield.',
            6 => 'All friendly knights have 45% chance to get a shield.',
        ),
        'Mage' => array(
            3 => 'Magic resistance decreased by 30 for all enemies.',
            6 => 'Magic resistance decreased by 60 for all enemies.',
        ),
        'Mech' => array(
            2 => 'HP regen increased by 15 for all friendly mechs.',
            4 => 'HP regen increased by 25 for all friendly mechs.',
        ),
        'Shaman' => array(
            2 => 'Hex an enemy when battle starts.',
        ),
        'Warlock' => array(
            3 => 'Lifesteal increased by 20% for all allies.',
            6 => 'Lifesteal increased by 30% for all allies.',
        ),
        'Warrior' => array(
            3 => 'Armour increased by 8 for all friendly warriors.',
            6 => 'Armour increased by 10 for all friendly warriors.',
        ),
    );

    private $name;
    private $race;
    private $class;
    private $cost;
    private $rarity;

    public function __construct($_name = "N/A", $_race = "N/A", $_class = "N/A", $_rarity = 'Common', $_cost = 0)
    {
        $this->name = $_name;
        $this->race = $_race;
        $this->class = $_class;
        $this->cost = $_cost;
        $this->rarity = $_rarity;
    }

    function getName()
    {
        return $this->name;
    }

    function getClass()
    {
        return $this->class;
    }

    function getCost()
    {
        return $this->cost;
    }

    function getRarity()
    {
        return $this->rarity;
    }

    function getRace()
    {
        $out = $this->race;
        if (!is_array($this->race)) {
            $out = array($this->race);
        }
        return $out;
    }
}


$chessPieces = array(
    new ChessPiece('Axe', ChessPiece::$RACE_ORC, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Enchantress', ChessPiece::$RACE_BEAST, ChessPiece::$CLASS_DRUID, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Ogre Magi', ChessPiece::$RACE_OGRE, ChessPiece::$CLASS_MAGE, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Tusk', ChessPiece::$RACE_BEAST, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Drow Ranger', ChessPiece::$RACE_UNDEAD, ChessPiece::$CLASS_HUNTER, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Bounty Hunter', ChessPiece::$RACE_GOBLIN, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Clockwerk', ChessPiece::$RACE_GOBLIN, ChessPiece::$CLASS_MECH, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Shadow Shaman', ChessPiece::$RACE_TROLL, ChessPiece::$CLASS_SHAMAN, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Bat Rider', ChessPiece::$RACE_TROLL, ChessPiece::$CLASS_KNIGHT, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Tinker', ChessPiece::$RACE_GOBLIN, ChessPiece::$CLASS_MECH, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Anti Mage', ChessPiece::$RACE_ELF, ChessPiece::$CLASS_DEMON_HUNTER, ChessPiece::$RARITY_COMMON, 1),
    new ChessPiece('Tiny', ChessPiece::$RACE_ELEMENT, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_COMMON, 1),

    new ChessPiece('Crystal', ChessPiece::$RACE_HUMAN, ChessPiece::$CLASS_MAGE, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Beast Master', ChessPiece::$RACE_ORC, ChessPiece::$CLASS_HUNTER, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Juggernaut', ChessPiece::$RACE_ORC, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Timbersaw', ChessPiece::$RACE_GOBLIN, ChessPiece::$CLASS_MECH, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Pain Queen', ChessPiece::$RACE_DEMON, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Puck', array(ChessPiece::$RACE_ELF, ChessPiece::$RACE_DRAGON), ChessPiece::$CLASS_MAGE, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Witch Doctor', ChessPiece::$RACE_TROLL, ChessPiece::$CLASS_WARLOCK, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Slardar', ChessPiece::$RACE_NAGA, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Chaos Knight', ChessPiece::$RACE_DEMON, ChessPiece::$CLASS_KNIGHT, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Treant Protector', ChessPiece::$RACE_ELF, ChessPiece::$CLASS_DRUID, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Morphling', ChessPiece::$RACE_ELEMENT, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Luna', ChessPiece::$RACE_ELF, ChessPiece::$CLASS_KNIGHT, ChessPiece::$RARITY_UNCOMMON, 2),
    new ChessPiece('Furion', ChessPiece::$RACE_ELF, ChessPiece::$CLASS_DRUID, ChessPiece::$RARITY_UNCOMMON, 2),

    new ChessPiece('Lycan', array(ChessPiece::$RACE_HUMAN, ChessPiece::$RACE_BEAST), ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Venomancer', array(ChessPiece::$RACE_HUMAN, ChessPiece::$RACE_BEAST), ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Omni Knight', ChessPiece::$RACE_HUMAN, ChessPiece::$CLASS_KNIGHT, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Razor', ChessPiece::$RACE_ELEMENT, ChessPiece::$CLASS_MAGE, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Wind Ranger', ChessPiece::$RACE_ELF, ChessPiece::$CLASS_HUNTER, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Phantom Assassin', ChessPiece::$RACE_ELF, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Abaddon', ChessPiece::$RACE_UNDEAD, ChessPiece::$CLASS_KNIGHT, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Sand King', ChessPiece::$RACE_BEAST, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Slark', ChessPiece::$RACE_NAGA, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Sniper', ChessPiece::$RACE_DWARF, ChessPiece::$CLASS_HUNTER, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Terrorblade', ChessPiece::$RACE_DEMON, ChessPiece::$CLASS_DEMON_HUNTER, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Viper', ChessPiece::$RACE_DRAGON, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Shadow Fiend', ChessPiece::$RACE_DEMON, ChessPiece::$CLASS_WARLOCK, ChessPiece::$RARITY_RARE, 3),
    new ChessPiece('Lina', ChessPiece::$RACE_HUMAN, ChessPiece::$CLASS_MAGE, ChessPiece::$RARITY_RARE, 3),

    new ChessPiece('Doom', ChessPiece::$RACE_DEMON, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Kunkka', ChessPiece::$RACE_HUMAN, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Troll Warlord', ChessPiece::$RACE_TROLL, ChessPiece::$CLASS_WARRIOR, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Light Keeper', ChessPiece::$RACE_HUMAN, ChessPiece::$CLASS_MAGE, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Necrophos', ChessPiece::$RACE_UNDEAD, ChessPiece::$CLASS_WARLOCK, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Templar Assassin', ChessPiece::$RACE_ELF, ChessPiece::$CLASS_ASSASSIN, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Alchemist', ChessPiece::$RACE_GOBLIN, ChessPiece::$CLASS_WARLOCK, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Disruptor', ChessPiece::$RACE_ORC, ChessPiece::$CLASS_SHAMAN, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Medusa', ChessPiece::$RACE_NAGA, ChessPiece::$CLASS_HUNTER, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Dragon Knight', array(ChessPiece::$RACE_HUMAN, ChessPiece::$RACE_DRAGON), ChessPiece::$CLASS_KNIGHT, ChessPiece::$RARITY_RARE, 4),
    new ChessPiece('Lone Druid', ChessPiece::$RACE_BEAST, ChessPiece::$CLASS_DRUID, ChessPiece::$RARITY_RARE, 4),

    new ChessPiece('Gyrocopter', ChessPiece::$RACE_DWARF, ChessPiece::$CLASS_MECH, ChessPiece::$RARITY_LEGENDARY, 5),
    new ChessPiece('Lich', ChessPiece::$RACE_UNDEAD, ChessPiece::$CLASS_MAGE, ChessPiece::$RARITY_LEGENDARY, 5),
    new ChessPiece('Tide Hunter', ChessPiece::$RACE_NAGA, ChessPiece::$CLASS_HUNTER, ChessPiece::$RARITY_LEGENDARY, 5),
    new ChessPiece('Enigma', ChessPiece::$RACE_ELEMENT, ChessPiece::$CLASS_WARLOCK, ChessPiece::$RARITY_LEGENDARY, 5),
    new ChessPiece('Techies', ChessPiece::$RACE_GOBLIN, ChessPiece::$CLASS_MECH, ChessPiece::$RARITY_LEGENDARY, 5),
);

echo $template->render(['chessPieces' => $chessPieces, 'races' => ChessPiece::$RACES, 'classes' => ChessPiece::$CLASSES, 'raceBonus' => ChessPiece::$RACE_BONUS, 'classBonus' => ChessPiece::$CLASS_BONUS]);