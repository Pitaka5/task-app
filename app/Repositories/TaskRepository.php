<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository {

    protected $model;

    public function __construct(Task $model){
        $this->model = $model;
    }

    public function save($form) {

        $values = $form->getFieldValues();
        $values['user_id'] = auth()->user()->id;

        $this->model->create($values);
    }
    public function getList() {

        return $this->model->where('user_id', auth()->user()->id)->paginate(10);
    }

    public function getListForExport() {

        $list = $this->model->where('user_id', auth()->user()->id)
            ->when(request()->filled('date_from'), function ($query) {
                $query->whereBetween('date', [request()->input('date_from'), request()->input('date_to')]);
            })->get();

        $fileName = 'task-report.'.request()->input('type');

        return [$list, $fileName];
    }

    public function checkIfCanAct($item) {

        if ($item->user_id != auth()->user()->id) {
            abort(404);
        }
    }
}