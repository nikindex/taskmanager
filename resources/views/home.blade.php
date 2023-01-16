@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(auth()->user()->isManager==0)
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="form-horizontal" action="{{route("addTask")}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <label class="col-2 col-form-label">Название</label>
                                    <div class="col-10">
                                        <input type="text" name="title" value="" required class="form-control">
                                    </div>

                                    <label class="col-2 col-form-label">Описание </label>
                                    <div class="col-10">
                                        <textarea name="describe" required class="form-control"></textarea>
                                    </div>

                                    <label class="col-2 col-form-label">Файл </label>
                                    <div class="col-10">
                                        <input type="file" required name="path_file">
                                    </div>

                                    <label class="col-2 col-form-label">время старта задачи </label>
                                    <div class="col-10">
                                        <input type="datetime-local" required name="startTask">
                                    </div>

                                    <label class="col-2 col-form-label">время завершения задачи </label>
                                    <div class="col-10">
                                        <input type="datetime-local" required name="endTask">
                                    </div>

                                    <div class="pt-3 row">
                                        <div class="col-10 offset-md-2">
                                            <button type="submit" required class="btn btn-success me-3">Добавить
                                                задачу
                                            </button>
                                        </div>
                                    </div>

                                </div>

                            </form>


                        @elseif(auth()->user()->isManager==1)

                            @if(!empty($tasks))
                                <table border="1">
                                    <tr>
                                        <td>ID</td>
                                        <td>название</td>
                                        <td>описание</td>
                                        <td> имя клиента</td>
                                        <td>почта клиента</td>
                                        <td>File</td>
                                        <td>дата создания</td>
                                        <td>дата и время старта</td>
                                        <td>дата и время завершения</td>
                                    </tr>
                                    @foreach($tasks as $task)
                                        <tr>
                                            <td>{{$task->id}}</td>
                                            <td>{{$task->title}}</td>
                                            <td>{{   $task->describe}}</td>
                                            <td>{{   $task->user->name}}</td>
                                            <td>{{   $task->user->email}}</td>
                                            <td><a href="/{{$task->path_file}}">{{$task->path_file}}</a></td>
                                            <td>{{$task->created_at}}</td>
                                            <td>{{$task->startTask}}</td>
                                            <td>{{$task->endTask}}</td>
                                        </tr>

                                    @endforeach
                                </table>
                                {!! $tasks->links('includes.pagination', ['data' => $tasks]) !!}
                            @endif
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
