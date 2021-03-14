<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\Forms\Task\TaskForm;
use App\Forms\Task\TaskExportForm;
use App\Repositories\TaskRepository;
use App\Exports\TaskExport;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    use FormBuilderTrait;

    protected $repository;

    public function __construct(TaskRepository $repository) {

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exportForm = $this->form(TaskExportForm::class, [
            'method' => 'POST',
            'url' => route('task.export')
        ]);
        $list = $this->repository->getList();

        return view('task.index', compact('list', 'exportForm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(TaskForm::class, [
            'method' => 'POST',
            'url' => route('task.store')
        ]);

        return view('task.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $this->form(TaskForm::class);
        $form->redirectIfNotValid();
        Task::create($form->getFieldValues());

        return redirect()->back()->withMessage(__('Created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function export()
    {
        $form = $this->form(TaskExportForm::class);
        $form->redirectIfNotValid();
        list($list, $fileName) = $this->repository->getListForExport();

        return Excel::download(new TaskExport($list), $fileName);
    }
}
