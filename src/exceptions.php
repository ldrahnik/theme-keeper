<?php

namespace ThemeKeeper;

/**
 * Interface Exception
 *
 * @author Lukáš Drahník (http://drahnik-lukas.com/)
 * @package ldrahnik\ThemeKeeper
 */
interface Exception
{

}

/**
 * Class InvalidParameter
 * @package ldrahnik\ThemeKeeper
 */
class ThemeNotFound extends \LogicException
{

}

/**
 * Class InvalidParameter
 * @package ldrahnik\ThemeKeeper
 */
class InvalidParameter extends \LogicException
{

}
