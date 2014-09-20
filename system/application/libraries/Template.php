<?php
class Template {
	function load($content){
		
		$CI =& get_instance();
		$template['header'] = $CI->load->view('public/inc/header', null,  TRUE);
		
		$template['content'] = $content;
		
		$template['footer'] = $CI->load->view('public/inc/footer', null, TRUE);
		
		$CI->load->view('public/inc/template', $template);
		
	}
}