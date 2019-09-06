<?php

namespace Persona;

use Exedra\Form\Form;
use Exedra\Session\Flash;
use Exedra\Session\Session;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Connection;
use Illuminate\Database\Query\Builder;
use Persona\Entity\User;
use Twig\Environment;

/**
 * @property Environment twig
 * @property Session session
 * @property Manager eloquent
 * @property Connection fluent
 * @method Builder fluent(string $table)
 * @property User user
 * @property Flash flash
 * @property Form form
 */
class Context extends \Exedra\Runtime\Context
{
}