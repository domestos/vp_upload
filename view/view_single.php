<?php
/**
 * Created by PhpStorm.
 * User: v.pelenskyi
 * Date: 27.09.2016
 * Time: 15:52
 */

if (!empty($_FILES)) {

/*
    if (!function_exists('wp_get_current_user')) {
        include(ABSPATH . "wp-includes/pluggable.php");
    }
*/

    if (!function_exists('wp_handle_upload')) {
        require_once(ABSPATH . "wp-admin" . '/includes/image.php');
        require_once(ABSPATH . "wp-admin" . '/includes/file.php');
        require_once(ABSPATH . "wp-admin" . '/includes/media.php');
    }

    $strin = '\$_FILES = ';
    $vp_array = $_FILES;
    print_array($vp_array, $string);

    $file = $_FILES['vp_file'];
    $string = ' $file = \$_FILES[\'vp_file\'];';
    $vp_array = $file;
    print_array($vp_array, $string);


    if (defined('UPLOADS'))
        $upload_dir_name = str_replace(trailingslashit(WP_CONTENT_DIR), '', untrailingslashit(UPLOADS));
    $vp_upload_url = $upload_dir_name . 'wp-content/uploads/kadastr';
    define('UPLOADS', $vp_upload_url);
    echo "My URL = " . $vp_upload_url . "<br>";

    $overrides = array('test_form' => false);
    $movefile = wp_handle_upload($_FILES['vp_file'], $overrides);

    if ($movefile) {
        echo "Файл был успешно загружен.";
        print_r($movefile);
    } else {
        echo "Возможны атаки при загрузке файла!";
    }

}


function vp_print_form_upload_files()
{
    ?>
    <form action="" enctype="multipart/form-data" method="post">
        <input type="file" name="vp_file">
        <input type="submit" name="vp_upload_submit" value="Single_upload">
    </form>
<?php }


function print_array($vp_array, $string)
{
    print $string;
    echo "<br><pre>";
    print_r($vp_array);
    echo "</pre>";
}


?>