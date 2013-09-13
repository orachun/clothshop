<?php

class Others extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function contact_us_form()
    {
        $data['is_logged_in'] = $this->session->userdata('IS_LOGGED_IN');
        $this->load->view('contact_us', $data);
    }
    
    public function contact_us_submit()
    {
        $this->load->library('email');
        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'orachun.chun@gmail.com';
        $config['smtp_pass']    = '14022010';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('orachun_chun@hotmail.com', 'Orachun');
        $this->email->to('orachun.chun@gmail.com'); 
        $this->email->subject('Contact from user');
        $this->email->message($this->input->post('msg'));  

        $this->email->send();
        echo 'ok';
    }
    
    
    function upload()
    {
        $output_dir = ___config('base_path')."uploads/temp/";
 
        if(isset($_FILES["file"]))
        {
            //Filter the file types , if you want.
            if ($_FILES["file"]["error"] > 0)
            {
              echo "Error: " . $_FILES["file"]["error"] . "<br>";
            }
            else
            {
                //move the uploaded file to uploads folder;
                $filename = uniqid().rand(0,9999).rand(0,9999).  ___config('upload_file_delim').$_FILES["file"]["name"];
                move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir. $filename);

             echo $filename;
            }

        }
    }
    
}
