<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = Task::take(2)->paginate(2);
        return view('home', compact('tasks'));
    }

    public function addTask(Task $task, TaskRequest $taskRequest)
    {


        $attributes = $taskRequest->except(['_token']);
        $attributes['userId'] = auth()->user()->id;
        // загрузка файла
        if ($taskRequest->isMethod('post') && $taskRequest->file('path_file')) {

            $file = $taskRequest->file('path_file');
            $upload_folder = 'public/files';
            $filename = $file->getClientOriginalName(); // image.jpg

            if (Storage::putFileAs($upload_folder, $file, $filename)) {

                //print_r($upload_folder."/".$filename);die();
                $attributes['path_file'] = $upload_folder . "/" . $filename;
            }

        }
        //$attributes->path_file
        $task->fill($attributes)->save();



        return view('home');
    }
}
