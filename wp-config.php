<?php
/** 
 * A configuração de base do WordPress
 *
 * Este ficheiro define os seguintes parâmetros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informação
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definições de MySQL são-lhe fornecidas pelo seu serviço de alojamento.
 *
 * Este ficheiro é usado para criar o script  wp-config.php, durante
 * a instalação, mas não tem que usar essa funcionalidade se não quiser. 
 * Salve este ficheiro como "wp-config.php" e preencha os valores.
 *
 * @package WordPress
 */

// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define('DB_NAME', 'lajuanita');

/** O nome do utilizador de MySQL */
define('DB_USER', 'root');

/** A password do utilizador de MySQL  */
define('DB_PASSWORD', '');

/** O nome do serviddor de  MySQL  */
define('DB_HOST', 'localhost');

/** O "Database Charset" a usar na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O "Database Collate type". Se tem dúvidas não mude. */
define('DB_COLLATE', '');

/**#@+
 * Chaves Únicas de Autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'l!=rG{`U.X4I:,p9@T$y)um)xeLH$;cJt@}j)cgSo(Y7t]HV4{a}H%_Y0T.w(G}F');
define('SECURE_AUTH_KEY',  'p:KLvxKahf9zqvo8M}a`_ `Wx`E5y*|hxhG?}roR)dlLE3M7Wz!J7;f9>j_-8Xj2');
define('LOGGED_IN_KEY',    'ykDMxD0B{k8!+;1x1BT&o [2LB+@lnOO{WtlI*Sp7wS)?-1sX2x+C6`Kf^YIb4jb');
define('NONCE_KEY',        'PiG+]UqJ)#7NPMbV0b;f(spTU&LYP;Z!ZRS4$OV|ZQ6)kI..WU6iV =RD2E<MYqS');
define('AUTH_SALT',        'C9)v&#FW;y^!$v6yafW,DPq_ZZj*~N6V%u=/%+OI~Hjx0)dnzuSQ^NGJke5.7Qr+');
define('SECURE_AUTH_SALT', '9cfraJR*6|+?CXh4b5#e&A#p~pVkDXAN<eB>a11rLZjt>/K;=8pb|6,a+yTErWH_');
define('LOGGED_IN_SALT',   '9gI~9X~cAG.cE7=rUAu:%>WQGPHaJ|*+?<RSjhFn3d1hbGad*t`:i}_LS_8wnmNF');
define('NONCE_SALT',       '+Lf|l)x8omR0BcW{3%-tA/t{I/ACC[0]P<HVqfcX`{`8=(k[TP(X(: ys}lSV}4a');

/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix  = 'LJ_';

/**
 * Idioma de Localização do WordPress, Inglês por omissão.
 *
 * Mude isto para localizar o WordPress. Um ficheiro MO correspondendo ao idioma
 * escolhido deverá existir na directoria wp-content/languages. Instale por exemplo
 * pt_PT.mo em wp-content/languages e defina WPLANG como 'pt_PT' para activar o
 * suporte para a língua portuguesa.
 */
define('WPLANG', 'pt_PT');

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 */
define('WP_DEBUG', false);

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Define as variáveis do WordPress e ficheiros a incluir. */
require_once(ABSPATH . 'wp-settings.php');
