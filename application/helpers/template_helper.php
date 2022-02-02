<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('element')) {

    function viewPage($base, $template, $data = null)
    {
        $ci = &get_instance();
        $data['view'] = $ci->load->view($template, $data, true);
        $ci->load->view($base, $data);
    }

}
