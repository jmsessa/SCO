<?php
define( 'WP_CACHE', true );

/**
 * A configuração de base do WordPress
 *
 * Este ficheiro define os seguintes parâmetros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informação
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definições de MySQL são-lhe fornecidas pelo seu serviço de alojamento.
 *
 * Este ficheiro contém as seguintes configurações:
 *
 * * Configurações de  MySQL
 * * Chaves secretas
 * * Prefixo das tabelas da base de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define( 'DB_NAME', 'sga_unibelas' );

/** O nome do utilizador de MySQL */
define( 'DB_USER', 'root' );

/** A password do utilizador de MySQL   Adelina1379., */
define( 'DB_PASSWORD', '' );

/** O nome do serviddor de  MySQL  */
define( 'DB_HOST', 'localhost' );

/** O "Database Charset" a usar na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O "Database Collate type". Se tem dúvidas não mude. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 's8pgzi`P0~E:5a*:5_7{$iThL]`C<NHoLzK;hFLg7ssEkE3^*_:.~$zq@$m^`a6.' );
define( 'SECURE_AUTH_KEY', '20]kN;(/pciS>9!|^1if?u`VO2]lN-xU!he+@;GLY6V&LOy_Z~i|~?)/&;)1]?=R' );
define( 'LOGGED_IN_KEY', 'q`DOUp&;Jjm[u_-9{}WFjO<)kD=9v_mTm[l.Fa~ukA4XkLY~`(.1St*{8}F%t>xl' );
define( 'NONCE_KEY', 'tmMF<:=+WT*ikk_6ta`e:^}uJ@%sH)bwbML)([&S:dA=G,O~1c0rGFyhL;4{K@Hz' );
define( 'AUTH_SALT', '>s@-fJyni,}`Dq}?~OJ=#T|Y;?e-uBdW&0)Ig4R+ZN>W1oSb}BE:tRA@,M]Jp5>o' );
define( 'SECURE_AUTH_SALT', '=0^3b ,5o^f,:lx:uF;~a,UuxE#!QHq5qlQ<7bM3hO7W8%HxhMgf5>q;BK`[{|-e' );
define( 'LOGGED_IN_SALT', '=,.AP->`#-QZxPT>&.j6;Yr,B 7@n$DUy2[B2E+8uYZ$<R9D]A/y1=f@GI[nbi$%' );
define( 'NONCE_SALT', 'g({]AeZt-Zmk6UD?f@1kOz+o}li;b=W4g o@+xF689X>m~(:T~rNfeHg5aw]fO<?' );

/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix = 'wp_';

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 *
 * Para mais informações sobre outras constantes que pode usar para debugging,
 * visite o Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Define as variáveis do WordPress e ficheiros a incluir. */
require_once( ABSPATH . 'wp-settings.php' );
