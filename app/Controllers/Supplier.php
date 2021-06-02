<?php

namespace App\Controllers;

use App\Models\SupplierModel;

class Supplier extends BaseController
{
    protected $supplierModel;

    public function __construct()
    {
        $this->supplierModel = new SupplierModel();
        helper('form');    
    }

    public function index()
    {
        $data = [
            'title' => 'Supplier',
            'all_data' => $this->supplierModel->findAll()
        ];

        return view('supplier/index', $data);
    }

    public function add_data()
    {
        $data['title'] = 'Add Data';
        if ($this->request->getPost()) {
            $rules = [
                'name' => 'required|alpha_space',
                'gender' => 'required',
                'address' => 'required',
                'photo' => 'uploaded[photo]|max_size[photo,2048]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]'
            ];

            if ($this->validate($rules)) {
                $photo = $this->request->getFile('photo');
                $photoName = $photo->getRandomName();
                $photo->move('photos', $photoName);

                $inserted = [
                    'name' => $this->request->getPost('name'),
                    'gender' => $this->request->getPost('gender'),
                    'address' => $this->request->getPost('address'),
                    'photo' => $photoName
                ];

                $this->supplierModel->insert($inserted);
                session()->setFlashData('success', 'data has been added to database');
                return redirect()->to('/supplier');
            } else {
                session()->setFlashData('failed', \Config\Services::validation()->getErrors());
                return redirect()->back()->withInput();
            }
        }
        return view('supplier/form_add', $data);
    }

    public function delete_data($id)
    {
        $photoId = $this->supplierModel->find($id);
        unlink('photos/'.$photoId['photo']);

        $this->supplierModel->delete($id);
        session()->setFlashData('Success', 'data has been deleted from database.');
        return redirect()->to('/supplier');
    }

    public function update_data($id)
    {
        $data = [
            'title' => 'Update Data',
            'dataById' => $this->supplierModel->where('id', $id)->first()
        ];

        if ($this->request->getPost()) {
            $rules = [
                'name' => 'required|alpha_space',
                'gender' => 'required',
                'address' => 'required',
                'photo' => 'max_size[photo,2048]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]'
            ];

            if ($this->validate($rules)) {
                $photo = $this->request->getFile('photo');
                if ($photo->getError() == 4) {
                    $photoName = $this->request->getPost('Oldphoto');
                } else {
                    $photoName = $photo->getRandomName();
                    $photo->move('photos', $photoName);
                    $photo = $this->supplierModel->find($id);
                    if ($photo['photo'] == $photo['photo']) {
                        unlink('photos/' . $this->request->getPost('Oldphoto'));
                    }
                }

                $inserted = [
                    'name' => $this->request->getPost('name'),
                    'gender' => $this->request->getPost('gender'),
                    'address' => $this->request->getPost('address'),
                    'photo' => $photoName
                ];

                $this->supplierModel->update($id, $inserted);
                session()->setFlashData('success', 'data has been updated from database');
                return redirect()->to('/supplier');
            } else {
                session()->setFlashData('failed', \Config\Services::validation()->getErrors());
                return redirect()->back()->withInput();
            }
        }
        return view('supplier/form_update', $data); 
    }
}
