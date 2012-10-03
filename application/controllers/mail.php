<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    /* Controller: Mail */

    class mail extends CI_Controller {
        

        // IMAP/POP3 (mail server) LOGIN
        var $imap_server    = 'www.meetuniv.com';
        var $imap_user        = 'kulbir@webinfomart.com';
        var $imap_pass        = 'kulbir2012!';

    
        // Constuctor
        
        function __construct() 
		{

            //parent::CI_Controller();
            
            $this->load->library('imap');
                        
        }

        // index
        
        function index() {
                    
            $inbox = $this->imap->cimap_open($this->imap_server, 'INBOX', $this->imap_user, $this->imap_pass) or die(imap_last_error());
    
            $data_array['totalmsg']    = $this->imap->cimap_num_msg($inbox);
            $data_array['quota']    = $this->imap->cimap_get_quota($inbox);
            
            $this->load->view('mail_view', $data_array);    
        }
    }

?>