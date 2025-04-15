<?php 



class Posts extends CI_Controller {


   public function __construct()
   {
      parent::__construct();
      $this->load->library('session');
   }

 public function index()
 {
   
    $data['title'] = 'Latest Posts';
    $data['posts'] = $this->post_model->get_posts();
    $data['comments_count'] = $this->comment_model->comments_count();

    $this->load->view('templates/header');
    $this->load->view('posts/index', $data);
    $this->load->view('templates/footer');
 }



   public function show($slug = null)
   {
      $data['post'] = $this->post_model->get_posts($slug);

      if (empty($data['post']))
      {
         show_404();
      }

    $post_id = $data['post']['id'];
    $data['comments'] = $this->comment_model->get_related_comment($post_id);

      $data['title'] = $data['post']['title'];
      $this->load->view('templates/header');
      $this->load->view('posts/show', $data);
      $this->load->view('templates/footer');
   }



   public function create()
   {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('body', 'Body', 'required|min_length[10]');
      $data['categories'] = $this->post_model->get_all_categories();

      if ($this->form_validation->run() == false)
      {
        $this->load->view('templates/header');
        $this->load->view('posts/create', $data);
        $this->load->view('templates/footer');

      } else {

        $postData = [
            'title' => $this->input->post('title'),
            'body' => $this->input->post('body'),
            'slug' => implode("-", explode(" ", $this->input->post('title'))),
            'category_id' => $this->input->post('category_id') 
        ];
         $this->post_model->insert_new($postData);
         $this->session->set_flashdata('success', 'Post created successfully!');

         redirect('posts');
      }
   }




   public function edit($id = null)
   {
       if ($id == null)
       {
           show_404();
       } 
       else
       {
           // Fetch post by ID
           $post = $this->post_model->get_post_by_id($id);
           $categories = $this->post_model->get_all_categories();

           if ($post) {
               $this->load->view('templates/header');
               $this->load->view('posts/edit', [
                   'title' => $post->title,
                   'body' => $post->body,
                   'id' => $post->id ,
                   'slug' => $post->slug,
                   'category_id' => $post->category_id,
                   'categories' => $categories
               ]);
               $this->load->view('templates/footer');
           } else {
               show_404();
           }
       }
   }
   


   public function update($id)
   {
       $this->load->helper('form');
       $this->load->library('form_validation');
   
       // Validation rules for form fields
       $this->form_validation->set_rules('title', 'Title', 'required');
       $this->form_validation->set_rules('body', 'Body', 'required|min_length[10]');
   
       // Fetching post data to populate the form if validation fails
       $post = $this->post_model->get_post_by_id($id);
   
       // If the post doesn't exist, show 404
       if (!$post) {
           show_404();
       }
   
       // If form validation fails, show the form with errors and existing values
       if ($this->form_validation->run() == false) {
           $this->load->view('edit', [
               'title' => $post->title,
               'body' => $post->body,
               'id' => $id // Pass slug to the view for the form action
           ]);
       } else {
           // Prepare data to update
           $data['title'] = $this->input->post('title');
           $data['body'] = $this->input->post('body');
           $data['slug'] = implode("-", explode(" ", $data['title']));
           $data['category_id'] = $this->input->post('category_id');
   
           // Call the model function to update the record
           $this->post_model->update_post($id, $data);
   
           // Redirect to the posts list or show the updated post
           redirect('posts');
       }
   }


   public function delete($id)
   {
      $post = $this->post_model->get_post_by_id($id);

      if (!$post)
      {
         show_404();
      } else {
         $this->post_model->delete($id);
         $this->session->set_flashdata('success_delete', 'Post Deleted successfully!');
         redirect('posts');
      }
   }
   
   
}