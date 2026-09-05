<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => 'USER',
	'password' => 'PASS',
	'database' => 'auc_website',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8mb4',
	'dbcollat' => 'utf8mb4_unicode_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['auth'] = array(
	'dsn'	=> '',
	'hostname' => '127.0.0.1',
	'username' => 'USER',
	'password' => 'PASS',
	'database' => 'auc_auth',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8mb4',
	'dbcollat' => 'utf8mb4_unicode_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['characters'] = array(
    'dsn'   => '',
    'hostname' => '127.0.0.1',
    'username' => 'USER',
    'password' => 'PASS',
    'database' => 'auc_chars',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

/**
 * Restauration de personnage - anciennes bases (lecture seule)
 *
 * 'chars_old' et 'auth_old' pointent vers les sauvegardes figees d'avant le
 * passage a une base de personnages propre (voir
 * application/modules/restauration/). Elles ne sont jamais ecrites, donc le
 * meme utilisateur MySQL que ci-dessus convient tant qu'il a au moins le
 * droit SELECT sur ces deux bases - importe simplement
 * auc_chars_old.sql / auc_auth_old.sql sous ces deux noms de base sur le
 * meme serveur avant d'activer cette fonctionnalite.
 */
$db['chars_old'] = array(
    'dsn'   => '',
    'hostname' => '127.0.0.1',
    'username' => 'USER',
    'password' => 'PASS',
    'database' => 'auc_chars_old',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

$db['auth_old'] = array(
    'dsn'   => '',
    'hostname' => '127.0.0.1',
    'username' => 'USER',
    'password' => 'PASS',
    'database' => 'auc_auth_old',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_unicode_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
