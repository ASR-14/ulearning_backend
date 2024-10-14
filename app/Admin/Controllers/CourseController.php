<?php
namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\CourseType;
use App\Models\Course;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Encore\Admin\Tree;


class CourseController extends AdminController
{

    // protected function grid(){
    //     $grid = new Grid(new Course());
    //     return $grid;
    // }

    protected function grid(){
        $grid = new Grid(new Course());
        $grid->column("id", __("Id"));
        $grid->column("user_token", __("Teacher"))->display(function ($token){
            return User::where("token",'=', $token)->value('name');
        });
        $grid->column("name", __("Name"));
        $grid->column("thumbnail", __("Thumbnail"))->image('',50,50);
        // $grid->column("video", __("Video"));
        $grid->column("description", __("Description"));
        $grid->column("type_id", __("Type id"));
        $grid->column("price", __("Price"));
        $grid->column("lesson_num", __("Lesson num"));
        $grid->column("video_length", __("Video length"));
        $grid->column("follow", __("Follow"));
        $grid->column("score", __("Score"));
        $grid->column("created_at", __("Created at"));
        $grid->column("updated_at", __("Updated at"));

        return $grid;
    }


    // protected function detail($id)
    // {
    //     $show = new Show(Course::findOrFail($id));

    //     $show->field('id', __('Id'));
    //     $show->field('title', __('Category'));
    //     $show->field('decription', __('Decription'));
    //     // $grid->column('password', __('Password'));
    //     $show->field('order', __('Order'));
    //     $show->field('created_at', __('Created at'));
    //     $show->field('updated_at', __('Updated at'));

    //     return $show;
    // }

    protected function detail($id){
        $show = new Show(Course::findOrFail($id));
        $show->field("id", __("Id"));
        // $show->field("user_token", __("User token"));
        $show->field("name", __("Name"));
        $show->field("thumbnail", __("Thumbnail"));
        // $show->field("video", __("Video"));
        $show->field("description", __("Description"));
        // $show->field("type_id", __("Type id"));
        $show->field("price", __("Price"));
        $show->field("lesson_num", __("Lesson num"));
        $show->field("video_length", __("Video length"));
        $show->field("follow", __("Follow"));
        $show->field("score", __("Score"));
        $show->field("created_at", __("Created at"));
        $show->field("updated_at", __("Updated at"));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Course());
        $form->text('name', __('Name'));
        $result = CourseType::pluck('title','id');
        $form->select('type_id', __('Category'))->options($result);
        $form->image('thumbnail', __('Thumbnail'))->uniqueName();
        // $form->select('parent_id', __('Parent Categoty'))->options((new CourseType())::selectOptions());
        $form->file('video', __('Video'))->uniqueName();
        $form->text('description', __('Description'));
        $form->decimal('price', __('Price'))->default(0);
        $form->number('lession_num', __('Lesson number'))->default(0);
        $form->number('video_length', __('Video lenght'))->default(0);
        $result = User::pluck('name','token');
        $form->select('user_token', __('Teacher'))->options($result);
        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated at'));



        // $form->text('title', __('Title'));
        // $form->textarea('description', __('Description'));
        // $form->number('order', __('Order'));

        return $form;
    }
}
