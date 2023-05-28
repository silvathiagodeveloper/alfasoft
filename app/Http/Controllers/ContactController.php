<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateContactRequest;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private ContactRepositoryInterface $repository;

    public function __construct(ContactRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $contacts = $this->repository->getAll();

        return view('contacts.index', [
            'contacts' => $contacts
        ]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(StoreUpdateContactRequest $request) 
    {
        $model = $this->repository->create($request->all());

        return redirect()->route('contacts.index')
                         ->with(config('constants.array_messages'),[
                            "Registro {$model->name} criado com sucesso!"
                        ]);
    }

    public function show($id) 
    {
        $contact = $this->repository->getById($id);
        return view('contacts.show',[
            'contact' => $contact
        ]);
    }

    public function destroy($id) 
    {
        $this->repository->delete($id);
        return redirect()->route('contacts.index');          
    }

    public function edit($id) 
    {
        $contact = $this->repository->getById($id);

        return view('contacts.edit',[
            'contact' => $contact
        ]);
    }

    public function update(StoreUpdateContactRequest $request, int $id) 
    {
        $this->repository->update($id, $request->except(['_token','_method']));

        return redirect()->route('contacts.index')
                        ->with(config('constants.array_messages'),[
                        "Registro alterado com sucesso!"
                    ]);
    }
}
