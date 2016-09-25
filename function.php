<?php
/**
 * Created by PhpStorm.
 * User: varenik
 * Date: 25.09.16
 * Time: 22:47
 */

// ============ activation and deactivation ===========================================================================
// метод запускається при активації плагіна
function activation_vp_upload_plugin()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'vp_upload_plugin';
    //get_var - повертає імя таблиці
    if ($wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name) {
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `name` varchar(40) ,
                    `text` text,
                    PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
        $wpdb->query($sql);
    }

    // добавляє рядок в таблицю wp_option із занченнями 'vp_upload_plugin', 5
    // це щось на подобі глобальної перемінної але вона зберігається в базі даних
    add_option('vp_upload_plugin', 5);

}
// метод запускається при деактивації плагіна
function deactivation_vp_upload_plugin()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'vp_upload_plugin';
    $sql = "DROP TABLE IF EXISTS  $table_name";
    $wpdb->query($sql);

    // видаляємо рядок з таблиці wp_option де є 'vp_upload_plugin'
    delete_option('vp_upload_plugin');

}
// ============ end activation and deactivation =======================================================================

// ============ create and registration menu +++=======================================================================
//vp_upload_title - заголовок меню; vp_upload_name_menu - назва меню; 8 - рівень достопу; vp_upload_menu - URL-unique
function implement_vp_upload_menu()
{   //формуємо пункти меню
    add_posts_page('vp_upload_title', 'vp_upload_name_menu', 8, 'vp_upload_url', 'vp_upload_function');
}
// робимо привʼязку: у admin_menu передаємо add_posts_page - оскільки фунція містить вхідні параметри,
// то на пряму передати ми її не можемо,
// для цього обертаємо її у фунцією (implement_vp_upload_menu) без вхідних параметрів
add_action('admin_menu', 'implement_vp_upload_menu');
function vp_upload_function()
{
    echo "this is my first plugin menu";
}
// ============ and create and registration menu +++=======================================================================





?>