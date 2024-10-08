<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 3;

        if (request('search')) {
            $data = Todo::where('task', 'like', '%' . request('search') . '%')->paginate($max_data);
        } else {
            $data = Todo::orderBy('task', 'asc')->paginate($max_data);
        }

        return view('todo.app', compact('data'));// ['data' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|max:25|min:3',
        ],
        [
            'task.required' => 'Task harus ada isinya',
            'task.max' => 'Tugas maksimal 25 karakter',
            'task.min' => 'Tugas minimal 3 karakter',   
        ]
    );

    $data = [
        'task' => $request->input('task'),
    ];

    Todo::create($data);

    return redirect('/todo')->with('success', 'Tugas baru ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|max:25|min:3',
        ],
        [
            'task.required' => 'Task harus ada isinya',
            'task.max' => 'Tugas maksimal 25 karakter',
            'task.min' => 'Tugas minimal 3 karakter',   
        ]
    );

    $data = [
        'task' => $request->input('task'),
        'is_done' => $request->input('is_done')
    ];

    Todo::where('id', $id)->update($data);

    return redirect()->route('todo')->with('success', 'Tugas diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();

        return redirect()->route('todo')->with('success', 'Tugas di hapus');
    }
}
