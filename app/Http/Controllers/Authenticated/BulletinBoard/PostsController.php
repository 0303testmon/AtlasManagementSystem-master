<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\BulletinBoard\CreateSubCategoryFormRequest;
use App\Http\Requests\BulletinBoard\PostEditFormRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $posts = Post::with('user', 'postComments')->get();
        $categories = MainCategory::get();
         $subcategories = subCategory::get();
        $like = new Like;
        $post_comment = new Post;
        // 20241027 add >>
        // if(!empty($request->keyword)){
        if(!empty($request->keyword) and !in_array($request->keyword, $subcategories->pluck("sub_category")->toArray())){
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
                // 1029 add
        // }else if($request->category_word){
        //     $sub_category = $request->category_word;
        }else if($request->category_word or in_array($request->keyword, $subcategories->pluck("sub_category")->toArray())){
            if(in_array($request->keyword, $subcategories->pluck("sub_category")->toArray())){
                $sub_category = $request->keyword;
            }else{
                // 1029 add
                $sub_category = $request->category_word;
            }
            // 1013 add
            // $posts = Post::with('user', 'postComments')->get();
                $posts = Post::whereHas(
                'subCategories', function($query) use($sub_category){
                    $query->where('sub_category',$sub_category);})->get();

        // 1027 add
        }else if($request->category){
            $sub_category = $request->category;
                $posts = Post::whereHas(
                'subCategories', function($query) use($sub_category){
                    $query->where('sub_category',$sub_category);})->get();

        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);
           // 20241014 add >>
        $post->subCategories()->attach($request->post_category_id);
        return redirect()->route('post.show');
    }

    public function postEdit(PostEditFormRequest $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    public function mainCategoryCreate(Request $request){
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }
    // 20240713 add >>
    public function subCategoryCreate(CreateSubCategoryFormRequest $request){
        // dd($request);
        // SubCategory::create(['sub_category' => $request->sub_category_name, 'main_category_id' => $request->main_category_id]);
        SubCategory::create(['sub_category' => $request->sub_category, 'main_category_id' => $request->main_category_id]);
        return redirect()->route('post.input');
    }
    // 20240713 add <<

    public function commentCreate(Request $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }

    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }

    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
