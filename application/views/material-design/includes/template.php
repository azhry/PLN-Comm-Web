<?php
	$this->load->view('material-design/includes/header', array('title' => $title));
	$this->load->view('material-design/includes/navbar');
	$this->load->view('material-design/includes/sidebar');
	$this->load->view($content);
	$this->load->view('material-design/includes/footer');
?>
