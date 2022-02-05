<?php

/**
 * ---------------------------------------------- |
 *            _____                       _       |
 *           /  __ \                     | |      |
 *           | /  \/ ___  _ __  ___  ___ | | ___  |
 *           | |    / _ \| '_ \/ __|/ _ \| |/ _ \ |
 *           | \__/\ (_) | | | \__ \ (_) | |  __/ |
 *            \____/\___/|_| |_|___/\___/|_|\___| |
 * ---------------------------------------------- |
 * Vladimir Navolykin | vnavolykin/console | 2022 |
 * ---------------------------------------------- |
 */

declare(strict_types=1);

namespace Console;

use Console\ConsoleEntities\IConsoleEntity;
use Console\Exceptions\ConsoleEntityNoHandlerClass;
use Console\Exceptions\ConsoleEntityHeandlerExists;

/**
 * This is a factory class, it returns console entities. To create an entity object,
 * use the 'getInstance' method.
 *
 * The following code will return the Console\ConsoleEntity\Message object,
 * format it and output it to the console.
 * Console\Console::getInstance('message')->color('red')
 *                                        ->bg('green')
 *                                        ->italic()
 *                                        ->writeln('Text');
 */
abstract class Console
{
    /**
     * array entity_name => entityHandler::class
     *
     * @var array
     */
    private static array $class_map = [
        'list' => 'Console\ConsoleEntities\Listing',
    ];

    /**
     * Namespace for default console entities.
     *
     * @var string
     */
    private static string $namespace = 'Console\ConsoleEntities\\';

    /**
     * Factory for creating console entities.
     * It first checks the name on the map, then tries to find the handler
     * dynamically, if it fails, throws an exception.
     *
     * @param string $entity  Name of the console entity.
     * @param mixed  ...$args Arguments that the created entity will receive.
     *
     * @throws ConsoleEntityNoHandlerClass Couldn't find handler class for
     *                                     console entity.
     *
     * @return IConsoleEntity
     */
    public static function getInstance(string $entity, ...$args): IConsoleEntity
    {
        if (isset(self::$class_map[strtolower($entity)])) {
            $class_name = self::$class_map[strtolower($entity)];
        } elseif (class_exists($entity)) {
            $class_name = $entity;
        } else {
            $class_name = self::$namespace . ucfirst(strtolower($entity));
        }

        if (!class_exists($class_name)) {
            throw new ConsoleEntityNoHandlerClass();
        }

        return new $class_name(...$args);
    }

    /**
     * Allows you to explicitly register a handler for a console entity or create
     * an alias to an existing one.
     *
     * @param string  $entity_name Console entity name.
     * @param string  $class_name  Console entity hamdler class.
     * @param boolean $override    If passed [true] it will overwrite the existing
     *                             name of the console entity.
     *
     * @throws ConsoleEntityNoHandlerClass Couldn't find handler class for
     *                                     console entity.
     * @throws ConsoleEntityHeandlerExists If the entity name is already registered
     *                                     and the 'override' flag is not passed.
     *
     * @return void
     */
    public static function addConsoleEntityHeandler(
        string $entity_name,
        string $class_name,
        bool $override = false
    ): void {
        if (!$override) {
            if (!isset(self::$class_map[$entity_name])) {
                throw new ConsoleEntityHeandlerExists();
            }
        }

        if (!class_exists($class_name)) {
            throw new ConsoleEntityNoHandlerClass();
        }

        self::$class_map[$entity_name] = $class_name;
    }
}
