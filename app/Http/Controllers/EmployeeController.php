<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employees = Employee::query();

        if ($request->filled('search')) {

            $employees->where(function ($query) use ($request) {

                $query->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%');

            });

        }

        if ($request->filled('status')) {

            $employees->where('status', $request->status);

        }

        if ($request->filled('department')) {

            $employees->where('department', $request->department);

        }

        $totalEmployees = Employee::count();

        $totalActive = Employee::where('status', 'aktif')->count();

        $totalInactive = Employee::where('status', 'nonaktif')->count();

        $departments = [
            'Human Resources',
            'Information Technology',
            'Finance',
            'Marketing',
            'Operations',
        ];

        $employees = $employees
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'employees.index',
            compact(
                'employees',
                'totalEmployees',
                'totalActive',
                'totalInactive',
                'departments'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = [
            'Human Resources',
            'Information Technology',
            'Finance',
            'Marketing',
            'Operations',
        ];

        return view('employees.create', compact('departments'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
                'nik' => 'required|unique:employees',
                'department' => 'required',
                'position' => 'required',
                'status' => 'required',
                'joined_at' => 'required|date',
            ],
            [
                'required' => ':attribute wajib diisi.',
                'unique' => ':attribute sudah digunakan.',
                'date' => ':attribute tidak valid.',
            ],
            [
                'name' => 'Nama Lengkap',
                'nik' => 'NIK',
                'department' => 'Departemen',
                'position' => 'Jabatan',
                'status' => 'Status',
                'joined_at' => 'Tanggal Bergabung',
            ]
        );

        Employee::create($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $departments = [
            'Human Resources',
            'Information Technology',
            'Finance',
            'Marketing',
            'Operations',
        ];

        return view(
            'employees.edit',
            compact(
                'employee',
                'departments'
            )
        );
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate(
            [
                'name'       => 'required|string|max:255',
                'nik'        => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('employees', 'nik')->ignore($employee->id),
                ],
                'department' => 'required|string|max:255',
                'position'   => 'required|string|max:255',
                'status'     => 'required|string|max:50',
                'joined_at'  => 'required|date',
            ],
            [
                'required' => ':attribute wajib diisi.',
                'unique' => ':attribute sudah digunakan.',
                'date' => ':attribute tidak valid.',
                'max' => ':attribute maksimal :max karakter.',
            ],
            [
                'name' => 'Nama Lengkap',
                'nik' => 'NIK',
                'department' => 'Departemen',
                'position' => 'Jabatan',
                'status' => 'Status',
                'joined_at' => 'Tanggal Bergabung',
            ]
        );

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()
            ->route('employees.index')
            ->with('success', 'Data pegawai berhasil dihapus.');
    }
}