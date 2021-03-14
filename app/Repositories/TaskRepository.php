<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository {

    protected $model;

    public function __construct(Task $model){
        $this->model = $model;
    }

    public function getList() {

        return $this->model->where('user_id', auth()->user()->id)->paginate(20);
    }
}