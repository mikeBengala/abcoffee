<?php
	function translate_course_level_to_pt($course_level){
		switch ($course_level) {
			case 'Foundation':
				return "Iniciado";
				break;
			case 'Intermediate':
				return "Intermédio";
				break;
			case 'Professional':
				return "Profissional";
				break;
			default:
				return $course_level;
				break;
		}
	}
?>