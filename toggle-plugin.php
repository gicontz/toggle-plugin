<?php
/** Plugin Name: gi-Toggle
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

add_action('wp_enqueue_scripts', 'gitoggle');



function gitoggle(){
    global $post;
    $mouseevent = (get_option('mouse_event') != '') ?  get_option('mouse_event'): 'click';
    $base_class = (get_option('gitoggle_bclass') != '') ? get_option('gitoggle_bclass') : 'question';
    $ansfield_class  = (get_option('gitoggle_ansclass') != '') ? get_option('gitoggle_ansclass') : 'answer' ;
    $gen_ansfield  = (get_option('gitoggle_ansclass') != '') ? get_option('gitoggle_ansclass') : 'answer' ;
    $ans_count = (get_option('gitoggle_anscount') != 0) ? get_option('gitoggle_anscount') : 1 ;    
    $page_id  = (get_option('page_id') != '') ? get_option('page_id') : 2 ;

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
    echo '$(".'.$base_class_name.'").css("cursor", "pointer");';
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

add_action('admin_menu', 'gitoggle_plugin_settings');

function gitoggle_plugin_settings() {
    //creecho ate new top-level menu
    add_menu_page('giToggle', 'giToggle', 'administrator', 'gitoggle_settings', 'gitoggle_display_settings', plugin_dir_url( __FILE__ ) . 'gitoggle.png', 5);
}

//Admin Style Sheet
function admin_register_head() {
    $siteurl = get_option('siteurl');
    $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/css/style.css';
    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}

//Generate HTML Code
function gitoggle_html_code(){
    global $post;
    $mouseevent = (get_option('mouse_event') != '') ?  get_option('mouse_event'): 'click';
    $base_class = (get_option('gitoggle_bclass') != '') ? get_option('gitoggle_bclass') : 'question';
    $ansfield_class  = (get_option('gitoggle_ansclass') != '') ? get_option('gitoggle_ansclass') : 'answer' ;
    $gen_ansfield  = (get_option('gitoggle_ansclass') != '') ? get_option('gitoggle_ansclass') : 'answer' ;
    $ans_count = (get_option('gitoggle_anscount') != 0) ? get_option('gitoggle_anscount') : 1 ;    
    $page_id  = (get_option('page_id') != '') ? get_option('page_id') : 2 ;

   $gitoggle_html_concat = '';
    for ($ref=1; $ref <= $ans_count; $ref++) { 
        $gitoggle_html_concat =  $gitoggle_html_concat . '<h2 class="'. $base_class . $ref .' ' . $base_class . '">Question</h2>
            <p class="'. $ansfield_class . $ref .' ' . $gen_ansfield .'">Answer</p>';
    }
    return $gitoggle_html =  '<div class="gitoggle-page'.$page_id.'">' . $gitoggle_html_concat . '</div>';
}

add_action('admin_head', 'admin_register_head');

function gitoggle_display_settings() {      

    $mouse_over = (get_option('mouse_event') == 'mouseover') ? 'selected' : '';
    $mouse_click = (get_option('mouse_event') == 'click') ? 'selected' : '';
    $base_class = (get_option('gitoggle_bclass') != '') ? get_option('gitoggle_bclass') : 'question';
    $ansfield_class  = (get_option('gitoggle_ansclass') != '') ? get_option('gitoggle_ansclass') : 'answer' ;
    $gen_ansfield  = (get_option('gitoggle_ansclass') != '') ? get_option('gitoggle_ansclass') : 'answer' ;
    $ans_count = (get_option('gitoggle_anscount') != 0) ? get_option('gitoggle_anscount') : 1 ;
    $page_id  = (get_option('page_id') != '') ? get_option('page_id') : 2 ;    


    $html = '<div class="wrap" id="gitoggle_admin">
            <h3>giToggle Wordpress Plugin</h3>
            <form method="post" name="options" action="options.php">

            <h2>Select Your Settings</h2>' . wp_nonce_field('update-options') . '
            <table width="70%" cellpadding="10">
                <tr>
                    <td align="left" scope="row">
                    <div class="help_label">
                    <label class="label">Mouse Event:</label>
                    <p class="help">How Answers be toggled by the mouse events..</p>
                    </div>                             
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
                    <div class="help_label">
                    <label class="label">Base Class Name:</label>
                    <p class="help">The Class Name for the Question Field</p>
                    </div>
                    </td> 
                    <td>
                    <input type="text" name="gitoggle_bclass" 
                    value="' . $base_class . '" />
                    </td>                
                </tr>
                <tr>
                    <td align="left" scope="row">                
                    <div class="help_label">
                    <label class="label">Answer Class Name:</label>
                    <p class="help">Class name for the answer field</p>
                    </div>
                    </td> 
                    <td>
                    <input type="text" name="gitoggle_ansclass" 
                    value="' . $ansfield_class . '" />
                    </td>
                </tr>
                <tr>
                    <td align="left" scope="row">
                    <div class="help_label">
                    <label class="label">Toggle Count:</label>
                    <p class="help">How Many Answers to be toggled?</p>
                    </div>
                    </td> 
                    <td>
                    <input type="number" min="0" name="gitoggle_anscount" 
                    value="' . $ans_count . '" />
                    </td>
                </tr>	
                <tr>
                    <td align="left" scope="row">
                    <div class="help_label">
                    <label class="label">Page Name:</label>
                    <p class="help">The specific page you will use the toggle</p>
                    </div>
                    </td> 
                    <td>
                    '. wp_dropdown_pages(). '
                    </td>
                </tr>   
                <tr>
                    <td align="left" scope="row">
                    <div class="help_label">
                    <label class="label">HTML Code:</label>
                    <p class="help">Copy the code and paste it on the page that you set on the settings, You can also 
                    Edit the html code according to the question and answer you need.</p>
                    </div>
                    </td> 
                    <td>
                    <textarea name="gitoggle_html">
                    '. gitoggle_html_code(). '
                    </textarea>
                    </td>
                </tr>                     
            </table>
            <p class="submit">
                <input type="hidden" name="action" value="update" />  
                <input type="hidden" name="page_options" value="gitoggle_bclass,mouse_event,gitoggle_ansclass,gitoggle_anscount, gitoggle_html, page_id" /> 
                <input type="submit" name="Submit" value="Update" style="color: #fff; background: #19A0E2; padding: 7px 20px; border-radius: 7px;
    border: none;"/>
            </p>
            </form>

        </div>';
    echo $html;  
}

?>