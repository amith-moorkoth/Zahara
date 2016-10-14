<?php
/**
 * Created by PhpStorm.
 * User: amith
 * Date: 10/12/2016
 * Time: 11:09 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class pinchecker extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        echo "Welcome to pinchecker";
    }
    public function check($pin)
    {
        header('Access-Control-Allow-Origin: *');
        $sql = "SELECT * FROM pin WHERE pincode= ?";
        $query = $this->db->query($sql, array($pin));
        echo json_encode($query->result());
    }
}
