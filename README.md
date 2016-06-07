# toggle-plugin


/** Plugin Name: iToggle
* Plugin URI: https://github.com/ghilo17/toggle-plugin
* Description: A Slider Toggle used for FAQ's
* Version: 1.0.1
* Author: Gimel Contillo
* Author URI: http://www.facebook.com/bijuumode
* License: MIT
* Date Released: June 2, 2016
*/

iToggle is a slider toggle from jQuery library which is oftenly needs in FAQ's to toggle answers so that the page will not be very long to scroll.
The author write this library to make his task in making pages FAQ's, Policies and like be easy to code or toggle.
Here are the iToggle documentation:

The PHP Code has it's own function 'toggleAnswer()'--toggleAnswer($num_ans, $base_class_name, $ansfield_class_name, $general_class_name_of_answer)
with its four (4) parameters-- $num_ans as integer, $base_class_name ass string, $ansfield_class_name as string, $general_class_name_of_answer as string.

$num_ans -> is a php variable refers to the maximum number of questions and answers to be toggle by the plugin
$base_class_name -> refers to the class name prefix of the question applies on any kind of html tag
$ansfield_class_name -> refers to the class name prefix of the answer applies on any kind of html tag
$general_class_name_of_answer -> refers to the class to be hide at the first load so that it will be showed only if the question or a tag with the class $base_class_name is clicked by a user

General Rules:
1. The class you will give for the questions and answers must be suffixed by a number e.g. question1, answer1
2. Every class for questions and answers must be incremented every new question e.g. 
						
						<p class="question1"> Question? </p>
						<p class="answer1 an-answer"> Answer </p>

						<p class="question2"> Question? </p>
						<p class="answer2 an-answer"> Answer </p>

3. How to Declare the function?

		On the header tag of your file:
		<header>
			<?php include('php/toggle-plugin.php');
			toggleAnswer(10, "question", "answer", "an-answer");
			?>
		</header>
			The 10 is the number of answers to be toggled
			The "question" is the class prefix to be clicked
			The "answer" is the class prefix to be toggled
			The "an-answer" is the general class that is needed to be added to the answer to be displayed or display: none 

For clarifications: Please email me at 61m37.17@gmail.com or add mo on facebook at fb.com/bijuumode

