<?php
// app/Controllers/Posts.php
namespace App\Controllers;

use App\Models\PostModel;
use CodeIgniter\Controller;

class Posts extends Controller
{
    protected $postModel;
    
    public function __construct()
    {
        $this->postModel = new PostModel();
    }
    
    // Display posts list
    public function index()
    {
        $data = [
            'posts' => $this->postModel->findAll(),
            'title' => 'Posts List'
        ];
        
        return view('posts/index', $data);
    }
    
    // Show create form
    public function create()
    {
        $data = [
            'title' => 'Create Post'
        ];
        
        return view('posts/create', $data);
    }
    
    // Process the form submission
    public function store()
    {
        // Validation rules
        $rules = [
            'title' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => 'Post title is required',
                    'min_length' => 'Title must be at least 3 characters',
                    'max_length' => 'Title cannot exceed 255 characters'
                ]
            ],
            'content' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Post content is required',
                    'min_length' => 'Content must be at least 10 characters'
                ]
            ]
        ];
        
        // Run validation
        if (!$this->validate($rules)) {
            // Return to form with errors
            return view('posts/create', [
                'validation' => $this->validator,
                'title' => 'Create Post'
            ]);
        }
        
        // If validation passes, save the post
        $this->postModel->save([
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status') ?? 'draft'
        ]);
        
        // Set flash message
        session()->setFlashdata('message', 'Post created successfully');
        
        // Redirect to posts list
        return redirect()->to('/posts');
    }
    
    // Show edit form
    public function edit($id = null)
    {
        $data = [
            'post' => $this->postModel->find($id),
            'title' => 'Edit Post'
        ];
        
        if(empty($data['post'])) {
            session()->setFlashdata('error', 'Post not found');
            return redirect()->to('/posts');
        }
        
        return view('posts/edit', $data);
    }
    
    // Update post
    public function update($id = null)
    {
        // Same validation rules as store
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]'
        ];
        
        if (!$this->validate($rules)) {
            return view('posts/edit', [
                'validation' => $this->validator,
                'post' => $this->postModel->find($id),
                'title' => 'Edit Post'
            ]);
        }
        
        $this->postModel->update($id, [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'status' => $this->request->getPost('status')
        ]);
        
        session()->setFlashdata('message', 'Post updated successfully');
        return redirect()->to('/posts');
    }
    
    // Delete post
    public function delete($id = null)
    {
        $post = $this->postModel->find($id);
        
        if($post) {
            $this->postModel->delete($id);
            session()->setFlashdata('message', 'Post deleted successfully');
        } else {
            session()->setFlashdata('error', 'Post not found');
        }
        
        return redirect()->to('/posts');
    }
}