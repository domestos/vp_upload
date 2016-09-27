<?php
/**
 * Created by PhpStorm.
 * User: v.pelenskyi
 * Date: 27.09.2016
 * Time: 10:17
 */

/*
 * дуже важлов звернути увагу на :
 * enctype='multipart/form-data' - обовязково указувати в формі інакше файл не буде передаватися
 * name='new_file[]'  multiple='true' - ящо тереба зававнатажити більше 1 файлу
 * передаваємий масив повинен бути приведений до такого типу
 *  Array
    (
        [name] => IMG_20160627_074826-PANO.jpg
        [type] => image/jpeg
        [tmp_name] => /tmp/phpQ6QKap
        [error] => 0
        [size] => 45543
    )
 * */

function vp_print_form_upload_files()
{

    echo "<form method='post' action='' enctype='multipart/form-data'>
         <input type='file' name='new_file[]'  multiple='true' />
         <input type='hidden' name='post_id' id='post_id' value='0' />
         <input  type='submit' name='new_upload_submit' value='Multiple Upload' />
      </form> ";
}

?>

<?php
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if ($_FILES) {
        $string = "<h2> 1) post FILES </h2>";
        print_array($_FILES, $string);

        if ( defined( 'UPLOADS' ) )
            $upload_dir_name = str_replace( trailingslashit( WP_CONTENT_DIR ), '', untrailingslashit( UPLOADS ) );
        $vp_upload_url=  $upload_dir_name.'wp-content/uploads/kadastr';
        define( 'UPLOADS',  $vp_upload_url );
        echo "My URL = ".$vp_upload_url."<br>";

        $pid = get_the_id();
        $files = $_FILES["new_file"];

        $string = "<h2> 2) \$files = \$_FILES[new_file] </h2>";
        print_array($files, $string);

        foreach ($files['name'] as $key => $value) {
            if ($files['name'][$key]) {
                $file = array(
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key],
                    'tmp_name' => $files['tmp_name'][$key],
                    'error' => $files['error'][$key],
                    'size' => $files['size'][$key]
                );
                $string = "<h2> 3) foreach (\$files['name'] as \$key => \$value)  </h2>";
                print_array($file, $string);


                $_FILES = array("new_file" => $file);

                $string = "<h2> 4)  \$_FILES = array (\"new_file\" => \$file);  </h2>";
                print_array($_FILES, $string);


                foreach ($_FILES as $file => $array) {

                    $string = "<h2> 5)  foreach (\$_FILES as \$file => \$array)  </h2>";
                    print_array($file, $string);
                    print_array($array, $string);

                    $newupload = kv_handle_attachment($file, $pid);
                    $atta = get_attached_file($newupload);
                }
            }
        }
    }

}

function print_array($vp_array, $string)
{
    print $string;
    echo "<br><pre>";
    print_r($vp_array);
    echo "</pre>";
}

;


function kv_handle_attachment($file_handler, $post_id, $set_thu = false)
{
    // check to make sure its a successful upload
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    $attach_id = media_handle_upload($file_handler, $post_id);

    // If you want to set a featured image frmo your uploads.
    if ($set_thu) set_post_thumbnail($post_id, $attach_id);
    return $attach_id;
}

?>