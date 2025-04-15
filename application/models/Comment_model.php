<?php 


class Comment_model extends CI_Model {


    public function __construct()
    {
        $this->load->database();
    }


    public function create_comment($post_id, $data)
    {
        $data['post_id'] = $post_id;
        return $this->db->insert('comments', $data);
    }


    public function get_related_comment($post_id)
    {
        $query = $this->db->get_where('comments', ['post_id' => $post_id]);
        return $query->result_array();
    }

    
    public function comments_count()
    {
        $query = $this->db->select('post_id, COUNT(*) as count')
                          ->group_by('post_id')
                          ->get('comments');
    
        $result = $query->result_array();
    
        $counts = [];
        foreach ($result as $row) {
            $counts[$row['post_id']] = $row['count'];
        }
    
        return $counts;
    }
    
}