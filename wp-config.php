<?php
define('DB_NAME', 'myDb');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
define( 'WP_HOME', 'http://localhost/task' );
define( 'WP_SITEURL', 'http://localhost/task' );
define('FS_METHOD', 'direct');
define('AUTH_KEY',         'Fuo|+2Tw&|*p<t_|cGP5aZ5:-3}~:Es@{4*CqbKbVuwVZ.M.G>~fKG0fdN)W9-Vt');
define('SECURE_AUTH_KEY',  'Zb$.4$=J]u.;tig!-UF ?+wPx^!qsigm(yU]G^@5(!VhOH-G)1%m4$WLYyE<-/1n');
define('LOGGED_IN_KEY',    'T%z|BUBdL(<B2J^C>&9lQ66.>t-RLxJS8~OeWFU|BZ7$>m .FPG&ka<7_E1TEGg,');
define('NONCE_KEY',        '1N3Z-n8v l`507youb{srdcy89u P=D#]&,|jE3kyQ6UpKa?,@eZ!gYHym)rR9a-');
define('AUTH_SALT',        ';?,ii+AaMp^$^x LwiSUQ-y Yl&[e3`cXVrUO|S|%IP2^*hJBMiWZoSej2KS,1J*');
define('SECURE_AUTH_SALT', '@}!QU/-RYhR/|c@9SL:F-V7ww-Ijub<m Wd !Ku+Rt-sr?-UioQN= [mGj*8C[f.');
define('LOGGED_IN_SALT',   '&e[7E2A|2 i$E&6Y%X:$^+OVg_$Q.R+l6i;%r%f&aYjr:7nF{8:5i7#R%Km#F9c^');
define('NONCE_SALT',       '08Uru7*ij<5H/-m01RiUp-eT7(-#;iXT*bq0a20bvq_yf$k.l7A:_8<&QPE>yn6k');


$table_prefix  = 'wp_';
define('WP_DEBUG', true);
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
$_SERVER['HTTPS'] = 'on';
}
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');