<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class search extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		$this->load->helper('string');
		$this->load->library('email');
		$this->ci =& get_instance();
		$this->load->library('fbConn/facebook');
	}
	
	function index()
	{
	}
	
	function college_search()
	{
			$data = $this->path->all_path();
			$data['err_div']=0;
			$this->load->view('auth/header',$data);
			$data['gallery_home'] = $this->users->fetch_home_gallery();
			$data['country'] = $this->users->fetch_country();
			$data['area_interest'] = $this->users->fetch_program();
			
		if($this->input->get('btn_col_search'))
		{
				//$this->form_validation->set_rules('type_search','Education Level','trim|required');
				//$this->form_validation->set_rules('search_country','Country','trim|required');
				
			//if($this->form_validation->run())
			//{
				$config['geocodeCaching'] = TRUE;
				//$this->googlemaps->initialize($config);
				$type_educ_level = $this->input->get('type_search');
				$search_country = $this->input->get('search_country');
				$search_course = $this->input->get('search_program');
				$data['get_university'] = $this->searchmodel->get_collages_by_search($type_educ_level,$search_country,$search_course);
				//print_r($data['get_university']);
				
				
				/* code for google map api v.3 */
				// Load the library
					$this->load->library('GMap');
					$this->gmap->GoogleMapAPI();
					$cnt_pos_univ = count($data['get_university']['position']);
					//print_r($data['get_university']['position'][0]);
					//echo 'Position-'.$cnt_pos_univ;
					// Initialize our map. Here you can also pass in additional parameters for customising the map (see below)
					//$this->googlemaps->initialize($config);
					// Create the map. This will return the Javascript to be included in our pages <head></head> section and the HTML code to be
					// placed where we want the map to appear.
					
					// valid types are hybrid, satellite, terrain, map
						$this->gmap->setMapType('map');

						// you can also use addMarkerByCoords($long,$lat)
						// both marker methods also support $html, $tooltip, $icon_file and $icon_shadow_filename
						$marker = array();
						//$marker_icon = 'http://localhost/www/Meet-Univ/images/location-marker.png';
						
							for($pos = 0; $pos < $cnt_pos_univ; $pos++)
							{
								$marker = explode(",",$data['get_university']['position'][$pos]);
								//print_r($marker['position']);
								$this->gmap->addMarkerByCoords($marker[1],$marker[0],$marker[2],$marker[3]);
								//$this->gmap->addOverlay();
								//$this->googlemaps->add_marker($marker);
							}
							
						
						//$this->$gmap->setMarkerIconKey($marker_icon,$marker_icon,0,0,10,10); 
						$data['headerjs'] = $this->gmap->getHeaderJS();
						$data['headermap'] = $this->gmap->getMapJS();
						$data['onload'] = $this->gmap->printOnLoad();
						$data['map'] = $this->gmap->printMap();
						$data['sidebar'] = $this->gmap->printSidebar();

					
					
					
					//$marker = array();
					// for($pos = 0; $pos < $cnt_pos_univ; $pos++)
					// {
						// $marker['position'] = $data['get_university']['position'][$pos];
						// $this->googlemaps->add_marker($marker);
					// }
					// $marker['position'] = '51.5115,-0.0921';
					// $this->googlemaps->add_marker($marker);
					//$data['map'] = $this->googlemaps->create_map();
					// Load our view, passing the map data that has just been created
					//$this->load->view('my_view', $data);
				
				if($data['get_university'] != 0)
				{
				$this->load->view('auth/listed_collage',$data);
				}
				else{
				$data['err_msg']='<h2> Sorry....</br><span class="text-align"> Page Not Found.... </span> </h2>';
				$data['err_div']=1;
				$this->load->view('auth/NotFoundPage',$data);
				}
			//}
			
		}
		else{
		$this->load->view('auth/listed_collage',$data);
		}
		$this->load->view('auth/footer',$data);
	}
}
?>