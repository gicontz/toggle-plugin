<?php
/** Plugin Name: iToggle
* Plugin URI:  https://github.com/ghilo17/toggle-plugin
* Description: A Slider Toggle used for FAQ's (Wordpress Plugin)
* Version: 1.5.0
* Author: Gimel Contillo
* Author URI: http://www.facebook.com/bijuumode
* License: MIT
*/
?>
<?php

//Start the function

add_action('wp_enqueue_scripts', 'itoggle');

global $post;
    $mouseevent = (get_option('mouse_event') != '') ?  get_option('mouse_event'): 'click';
    $base_class = (get_option('itoggle_bclass') != '') ? get_option('itoggle_bclass') : 'question';
    $ansfield_class  = (get_option('itoggle_ansclass') != '') ? get_option('itoggle_ansclass') : 'answer' ;
    $gen_ansfield  = (get_option('itoggle_ansclass') != '') ? get_option('itoggle_ansclass') : 'answer' ;
    $ans_count = (get_option('itoggle_anscount') != 0) ? get_option('itoggle_anscount') : 1 ;    
    $page_id  = (get_option('page_id') != '') ? get_option('page_id') : 2 ;

 $itoggle_html =  '<div class="itoggle-page'.$page_id.'">' .  . '</div>';
    // echo $itoggle_html;
function itoggle_html_code(){
   $itoggle_html_concat = '';
    for ($ref=1; $ref <= $ans_count; $ref++) { 
        $itoggle_html_concat = '<h2 class="'. $base_class . $ref .'">Question</h2>
            <p class="'. $ansfield_class . $ref .' ' . $gen_ansfield .'">Answer</p>';

    }
}

function itoggle(){
    if ($post->ID == $page_id) {
        echo '<script src="https://code.jquery.com/jquery-2.2.0.js"></script>';
        toggleAnswer($ans_count, $base_class, $ansfield_class, $ansfield_class, $mouseevent);
    }
}   

function toggleAnswer($num_ans, $base_class_name, $ansfield_class_name, $general_class_name_of_answer, $mouse_event){
	?>
<script type="text/javascript">
$(document).ready(function(){
<?php 

	echo '$(".'.$general_class_name_of_answer.'").css("display", "none");';	
for ($i=1; $i <= $num_ans; $i++) {	
	echo '
	var pa = ".'.$base_class_name.'";
	var ans = ".'.$ansfield_class_name.'";
	var c1_'.$i.' = pa.concat(""+'.$i.');
	var c2_'.$i.' = ans.concat(""+'.$i.');
	$(c1_'.$i.').'.$mouse_event.'(function(){
    $(c2_'.$i.').slideToggle();
	}); ';
}
?>
});
</script>
<?php
}

add_action('admin_menu', 'itoggle_plugin_settings');

function itoggle_plugin_settings() {
    //creecho ate new top-level menu
    add_menu_page('iToggle', 'iToggle', 'administrator', 'itoggle_settings', 'itoggle_display_settings', plugin_dir_url( __FILE__ ) . 'itoggle.png', 5);
}

//Admin Style Sheet
function admin_register_head() {
    $siteurl = get_option('siteurl');
    $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/style.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('admin_head', 'admin_register_head');

function itoggle_display_settings() {      

    $mouse_over = (get_option('mouse_event') == 'mouseover') ? 'selected' : '';
    $mouse_click = (get_option('mouse_event') == 'click') ? 'selected' : '';
    $base_class = (get_option('itoggle_bclass') != '') ? get_option('itoggle_bclass') : 'question';
    $ansfield_class  = (get_option('itoggle_ansclass') != '') ? get_option('itoggle_ansclass') : 'answer' ;
    $gen_ansfield  = (get_option('itoggle_ansclass') != '') ? get_option('itoggle_ansclass') : 'answer' ;
    $ans_count = (get_option('itoggle_anscount') != 0) ? get_option('itoggle_anscount') : 1 ;
    $page_id  = (get_option('page_id') != '') ? get_option('page_id') : 2 ;

    $html = '<div class="wrap">

            <form method="post" name="options" action="options.php">

            <h2>Select Your Settings</h2>' . wp_nonce_field('update-options') . '
            <table width="40%" cellpadding="10">
                <tr>
                    <td align="left" scope="row">
                    <label>Mouse Event:</label>                             
                    </td> 
                    <td align="left" scope="row">
                    <select name="mouse_event" >
                      <option value="mouseover" ' . $mouse_over . '>Hover</option>
                      <option value="click" '.$mouse_click.'>Click</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Base Class Name:</label>
                    </td> 
                    <td>
                    <input type="text" name="itoggle_bclass" 
                    value="' . $base_class . '" />
                    </td>                
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Answer Class Name:</label>
                    </td> 
                    <td>
                    <input type="text" name="itoggle_ansclass" 
                    value="' . $ansfield_class . '" />
                    </td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>Toggle Count:</label>
                    </td> 
                    <td>
                    <input type="number" min="0" name="itoggle_anscount" 
                    value="' . $ans_count . '" />
                    </td>
                </tr>	
                <tr>
                    <td align="left" scope="row">
                    <label>Page Name:</label>
                    </td> 
                    <td>
                    '. wp_dropdown_pages(). '
                    </td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <label>HTML Code:</label>
                    </td> 
                    <td>
                    <textarea>
                    '. itoggle_html_code() .'
                    </textarea>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="itoggle_bclass,mouse_event,itoggle_ansclass,itoggle_anscount, page_id" /> 
                <input type="submit" name="Submit" value="Update" style="color: #fff; background: #19A0E2; padding: 7px 20px; border-radius: 7px;
    border: none;"/>
            </p>
            </form>

        </div>';
    echo $html;  
}

?>
