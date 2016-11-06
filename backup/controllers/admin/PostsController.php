<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Post;
use URL;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;
use DB;

class PostsController extends AdminController
{

    protected $post;

      public function __construct(Post $post)
      {
          $this->post = $post;
      }

    /**
     * Show a list of all the blog posts.
     *
     * @return View
     */
    public function getIndex()
    {
        // Grab all the blog posts
        $posts = $this->post->orderBy('created_at', 'DESC')->paginate(10);

        // Show the page
        return View::make('backend/posts/index', compact('posts'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getPriorityList()
    {
        $posts = $this->post
            ->with(array(
                'author' => function ($query) {
                    $query->withTrashed();
                },
            ))
            ->orderBy('priority', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return View::make('backend.posts.priority_list', compact('posts'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function setPriority($id,$priority)
    {
        DB::beginTransaction();
        // set all others priority to 0
        $this->post->where('priority',$priority)->update(array('priority'=>0));
        $post = $this->post->find($id);
        $input['priority'] = $priority;
        if ($post->update($input)) {
            DB::commit();
            return Redirect::back()->with('success', Lang::get('posts/message.update.success'));
        }
        DB::rollback();
        return Redirect::back()->with('error', Lang::get('posts/message.update.error'));
    }
    /**
     * Blog post create.
     *
     * @return View
     */
    public function getCreate()
    {
        // Show the page
        return View::make('backend/posts/create');
    }

    /**
     * Blog post create form processing.
     *
     * @return Redirect
     */
    public function postCreate()
    {

        // get the  data
        $new = Input::all();
        $post = new Post;

        if (Input::get('slug')) {
            Input::merge(array('slug' => Input::get('slug')));
        } else {
            Input::merge(array('slug' => Str::slug(Input::get('title'))));
        }


        if ($post->validate($new)) {

             // Update the blog post data
            $post->title            = e(Input::get('title'));
            $post->content          = e(Input::get('content'));
            $post->slug             = e(Input::get('slug'));
            $post->meta_title       = e(Input::get('meta-title'));
            $post->meta_description = e(Input::get('meta-description'));
            $post->meta_keywords    = e(Input::get('meta-keywords'));
            $post->user_id          = Sentry::getUser()->id;

            // Was the blog post created?
            if ($post->save()) {
                // Redirect to the new blog post page
                return Redirect::to("admin/posts/$post->id/edit")->with('success', Lang::get('admin/posts/message.create.success'));
            }

        } else {
            // If validation fails, we'll exit the operation now with errors
            return Redirect::back()->withInput()->withErrors($post->errors());
        }

        // Redirect to the blog post create page
        return Redirect::to('admin/posts/create')->with('error', Lang::get('admin/posts/message.create.error'));
    }

    /**
     * Blog post update.
     *
     * @param  int  $postId
     * @return View
     */
    public function getEdit($postId = null)
    {
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/blogs')->with('error', Lang::get('admin/posts/message.does_not_exist'));
        }

        // Show the page
        return View::make('backend/posts/edit', compact('post'));
    }

    /**
     * Blog Post update form processing page.
     *
     * @param  int      $postId
     * @return Redirect
     */
    public function postEdit($postId = null)
    {
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/blogs')->with('error', Lang::get('admin/posts/message.does_not_exist'));
        }

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'slug'   => "unique:posts,id,$postId",
            'content' => 'required|min:3',
        );

        if (Input::get('slug')) {
            Input::merge(array('slug' => Input::get('slug')));
        } else {
            Input::merge(array('slug' => Str::slug(Input::get('title'))));
        }

        // Create a new validator instance from our validation rules
        $validator = Validator::make(Input::all(), $rules);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            // Ooops.. something went wrong
            return Redirect::back()->withInput()->withErrors($validator);
        }

        // Update the blog post data
        $post->title            = e(Input::get('title'));
        $post->slug             = e(Input::get('slug'));
        $post->content          = e(Input::get('content'));
        $post->meta_title       = e(Input::get('meta-title'));
        $post->meta_description = e(Input::get('meta-description'));
        $post->meta_keywords    = e(Input::get('meta-keywords'));

        // Was the blog post updated?
        if ($post->save()) {
            // Redirect to the new blog post page
            return Redirect::to("admin/posts/$postId/edit")->with('success', Lang::get('admin/posts/message.update.success'));
        }

        // Redirect to the blogs post management page
        return Redirect::to("admin/posts/$postId/edit")->with('error', Lang::get('admin/posts/message.update.error'));
    }

    /**
     * Delete confirmation for the given blog post.
     *
     * @param  int      $postId
     * @return View
     */
    public function getModalDelete($postId)
    {
        $model = 'posts';
        $confirm_route = $error = null;
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {

            $error = Lang::get('admin/posts/message.not_found');
            return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
        }

        $confirm_route =  URL::action('delete/post', array('id'=>$post->id));
        return View::make('backend/layouts/modal_confirmation', compact('error', 'model', 'confirm_route'));
    }

    /**
     * Delete the given blog post.
     *
     * @param  int      $postId
     * @return Redirect
     */
    public function getDelete($postId)
    {
        // Check if the blog post exists
        if (is_null($post = $this->post->find($postId))) {
            // Redirect to the blogs management page
            return Redirect::to('admin/posts')->with('error', Lang::get('admin/posts/message.not_found'));
        }

        // Delete the blog post
        $post->delete();

        // Redirect to the blog posts management page
        return Redirect::to('admin/posts')->with('success', Lang::get('admin/posts/message.delete.success'));
    }

}
