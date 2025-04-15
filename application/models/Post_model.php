<?php 


class Post_model extends CI_Model {


    public function __construct()
    {
        $this->load->database();
    }


    public function get_posts($slug = false)
    {
        if ($slug == false)
        {
            $this->db->select('posts.*, categories.name as category_name');
            $this->db->from('posts');
            $this->db->join('categories', 'posts.category_id = categories.id');
            $this->db->order_by('posts.created_at', 'DESC');
            $query = $this->db->get();
            return $query->result_array();
        }

            $this->db->select('posts.*, categories.name AS category_name');
            $this->db->from('posts');
            $this->db->join('categories', 'posts.category_id = categories.id');
            $this->db->where('posts.slug', $slug);
            $query = $this->db->get();
            return $query->row_array();
    }


    public function insert_new($data)
    {
        $this->db->insert('posts', $data);
    }


    public function get_post_by_id($id)
    {
        $this->db->select('posts.*, categories.name AS category_name');
        $this->db->from('posts');
        $this->db->join('categories', 'posts.category_id = categories.id');
        $this->db->where('posts.id', $id);
        $query = $this->db->get();
        return $query->row(); 
    }
    

    
   public function update_post($id, $data)
    {
        $this->db->where('id', $id);  
        $this->db->update('posts', $data); 
    }



    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('posts'); 
    }
    

    public function get_all_categories()
    {
        $this->db->order_by('name');
        $query = $this->db->get('categories');
        return $query->result_array();
    }


}