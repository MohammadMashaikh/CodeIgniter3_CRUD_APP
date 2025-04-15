<?php 


class Comments extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
       $this->load->library('session');
    }
 



    public function create($post_id)
    {
        $slug = $this->input->post('slug');
        $data['post'] = $this->post_model->get_posts($slug);

       $this->load->helper('form');
       $this->load->library('form_validation');
       $this->form_validation->set_rules('name', 'Name', 'required');
       $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
       $this->form_validation->set_rules('body', 'Body', 'required|min_length[10]');
       
 
       if ($this->form_validation->run() == false)
       {
         $this->load->view('templates/header');
         $this->load->view('posts/show', $data);
         $this->load->view('templates/footer');
       } else {
        
         $commentData = [
             'name' => $this->input->post('name'),
             'email' => $this->input->post('email'),
             'body' => $this->input->post('body'),
             'post_id' => $this->input->post('post_id') 
         ];

         $this->comment_model->create_comment($post_id, $commentData);
         $this->session->set_flashdata('success_comment', 'Comment created successfully!');
         redirect('posts/' . $slug);

        }
    }

}