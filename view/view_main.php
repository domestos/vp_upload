<?php
/**
 * Created by PhpStorm.
 * User: v.pelenskyi
 * Date: 28.09.2016
 * Time: 9:55
 */

if(isset($_POST['vp_upload_radio']) && !empty($_POST['vp_upload_radio'])){

 echo "[vp_upload type='".$_POST['vp_upload_radio']."' ]";
}else{
    echo "you must select ether _multiple or _single. pleas make your choice";
}
?>

<form method="post">
    <label content="radio1">
        <p> <input id="radia1" type="radio" name="vp_upload_radio" value="_multiple"> _multiple</p>
    </label>
    <label content="radio2">
       <p> <input id="radia1" type="radio" name="vp_upload_radio" value="_single"> _single</p>
    </label>
    <input type="submit" name="vp_choice_submit" value="Згенерувати шорткод">
</form>
