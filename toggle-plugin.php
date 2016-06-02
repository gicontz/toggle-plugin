<?php
/** Plugin Name: iToggle
* Plugin URI: http://danielpataki.com
* Description: A Slider Toggle used for FAQ's
* Version: 1.0.0
* Author: Gimel Contillo
* Author URI: http://danielpataki.com
* License: MIT
*/
?>
<script type="text/javascript" src="jquery-2.2.0.min.js"></script>
<?php

function toggleAnswer($num_ans, $base_class_name, $ansfield_class_name, $general_class_name_of_answer){
	?>
<script>
$(document).ready(function(){
<?php 

	echo '$(".'.$general_class_name_of_answer.'").css("display", "none")';

for ($i=1; $i <= $num_ans; $i++) {	
	echo '
	var pa = ".'.$base_class_name.'";
	var ans = ".'.$ansfield_class_name.'";
	var c1_'.$i.' = pa.concat(""+'.$i.');
	var c2_'.$i.' = ans.concat(""+'.$i.');
	$(c1_'.$i.').click(function(){
    $(c2_'.$i.').slideToggle();
	}); ';
}
?>
});
</script>
<?php
}
?>

<script type="text/javascript">

$(".dog").css("color", "blue");
</script>