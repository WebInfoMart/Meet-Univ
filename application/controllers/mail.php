<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    /* Controller: Mail */

    class Mail extends CI_Controller {
        

        // IMAP/POP3 (mail server) LOGIN
        //var $imap_server    = '{localhost/imap : 143}';
        var $imap_user        = 'kulbir@webinfomart.com';
        var $imap_pass        = 'kulbir2012!';

    
        // Constuctor
        
        function __construct() 
		{
			parent::__construct();
           // parent::CI_Controller();
            
            $this->load->library('Imap');
                        
        }

        // index
        
        function index() {
                    
            $inbox = $this->imap->imap_open("{www.meetuniv.com:995/pop3/ssl/novalidate-cert}", 'INBOX', $this->imap_user, $this->imap_pass);
			
            $data_array['totalmsg']    = $this->imap->imap_num_msg($inbox);
            $data_array['quota']    = $this->imap->imap_get_quota($inbox);
            
            $this->load->view('mail', $data_array);    
        }
    }

?>