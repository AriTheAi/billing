<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function fetchBlogPosts()
    {
        $sql = DB::table('blog_posts')->paginate(15);
        return $sql;
    }
    public function homepage(Request $request)
    {
        $posts = $this->fetchBlogPosts();
        $data = [
                    'posts' => $posts
                ];
        return view('public/bloghome', $data);
    }
    public function getBlogPost($id)
    {
        $sql = DB::table('blog_posts')->where('id','=',$id)->get();
        return $sql[0];
    }
    public function viewBlogPost(Request $request, $id)
    {
        if(!is_numeric($id)) {
            abort(404);
        }
        $postData = $this->getBlogPost($id);
        $data = [
                    'post' => $postData
                ];
        return view('public/blogviewpost', $data);
    }
}