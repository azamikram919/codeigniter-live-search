<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Autocomplete extends CI_Controller { 
  
 public function __construct()  {
        parent:: __construct();
        $this->load->model("MAutocomplete");
    }
      
    public function index(){
        $this->load->view('autocomplete/show');
    }
    public function search()
    {
        $this->form_validation->set_rules('printable_name','Query','required');
        $this->form_validation->set_error_delimiters('<p class="text-danger text-center">','</p>');
        if ($this->form_validation->run()==true) 
        {
            $query=$this->input->post('printable_name');
            if ($this->MAutocomplete->_search($query)==true) 
            {
                $data['result']=$this->MAutocomplete->_search($query);
            }
            else
            {
                $data['result']=NULL;
            }
            $this->load->view('autocomplete/show',$data);
        }
        else
        {
            $this->index();
        }
    }
    public function lookup(){
        // process posted form data
        $keyword = $this->input->post('term');
        $data['response'] = 'false'; //Set default response
        $query = $this->MAutocomplete->lookup($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] = 'true'; //Set response
            $data['message'] = array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array( 
                                        'id'=>$row->id,
                                        'value' => $row->printable_name,
                                        ''
                                     );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
              
        }
        else
        {
            $this->load->view('autocomplete/index',$data); //Load html view of search results
        }
    }
}