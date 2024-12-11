<?php

namespace App\Controllers;

use App\Models\partsModel;

class Parts extends BaseController
{
    protected $parts;
    public function __construct()
    {
        $this->parts = new partsModel();
    }
    public function index()
    {
        $partData = $this->parts->findAll();

        $data = [
            'parts' => $partData
        ];

        return view('parts/data', $data);
    }

    public function add()
    {
        return view('parts/addForm');
    }

    public function saveData()
    {
        $nameparts = $this->request->getPost('nameparts');
        $price = $this->request->getPost('price');
        $suite = $this->request->getPost('suite');

        $validation = \Config\Services::validation();

        $doValid = $this->validate([
            'nameparts' => [
                'label'  => 'Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Can\'t be Empty'
                ]
            ],
            'price' => [
                'label'  => 'Price',
                'rules'  => 'required',
                'errors' => [
                    'required'  => '{field} Can\'t be empty',
                ]
            ],
            'suite' => [
                'label'  => 'Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Can\'t be Empty'
                ]
            ],
            'iconUpload' => [
                'label' => 'Icon',
                'rules' => 'mime_in[iconUpload,image/png,image/jpeg]|ext_in[iconUpload,png,jpg]|is_image[iconUpload]',
                'errors' => [
                    'mime_in'  => 'The {field} must be a valid image format (PNG, JPEG).',
                    'ext_in'   => 'The {field} must have a valid extension (PNG, JPG).',
                    'is_image' => 'The {field} must be a valid image.',
                ],
            ],
        ]);

        if (!$doValid) {
            $msg = [
                'error' => [
                    'errorName' => $validation->getError('nameparts'),
                    'errorPrice' => $validation->getError('price'),
                    'errorSuite' => $validation->getError('suite'),
                    'errorIconUpload' => $validation->getError('iconUpload'),
                ]
            ];
        } else {
            $file_upload = $_FILES['iconUpload']['name'];

            if ($file_upload != NULL) {
                $changedname = str_replace(' ', '-', $nameparts);
                $changedsuite = str_replace(' ', '-', $suite);
                $image_name = "$changedname-$changedsuite";
                $image_file = $this->request->getFile('iconUpload');
                $image_file->move('assets/upload/parts/', $image_name . '.' . $image_file->getExtension());

                $path_image = '/assets/upload/parts/' . $image_file->getName();
            } else {
                $path_image = '';
            }

            $this->parts->insert([
                'namaparts' => $nameparts,
                'price' => $price,
                'suite' => $suite,
                'icon' => $path_image
            ]);

            $msg = ['success' => 'Parts Successfully Added'];
        }

        echo json_encode($msg);
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $rowDataParts = $this->parts->find($id);

            if ($rowDataParts && !empty($rowDataParts['image'])) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . $rowDataParts['image'];

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $this->parts->delete($id);

            $msg = [
                'success' => 'Parts Deleted Successfully'
            ];

            echo json_encode($msg);
        }
    }

    public function edit($id)
    {
        $row = $this->parts->where('idparts', $id)->first();

        if ($row) {
            $data = [
                'id' => $row['idparts'],
                'nameparts' => $row['namaparts'],
                'price' => $row['price'],
                'suite' => $row['suite'],
                'icon' => $row['icon'],
            ];
            return view('parts/editForm', $data);
        } else {
            exit('No Data Found 404');
        }
    }

    public function updateData()
    {
        $id = $this->request->getPost('id');
        $nameparts = $this->request->getPost('nameparts');
        $price = $this->request->getPost('price');
        $suite = $this->request->getPost('suite');

        $validation = \Config\Services::validation();

        $doValid = $this->validate([
            'nameparts' => [
                'label'  => 'Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Can\'t be Empty'
                ]
            ],
            'price' => [
                'label'  => 'Price',
                'rules'  => 'required',
                'errors' => [
                    'required'  => '{field} Can\'t be empty',
                ]
            ],
            'suite' => [
                'label'  => 'Name',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Can\'t be Empty'
                ]
            ],
            'iconUpload' => [
                'label' => 'Icon',
                'rules' => 'mime_in[iconUpload,image/png,image/jpeg]|ext_in[iconUpload,png,jpg]|is_image[iconUpload]',
                'errors' => [
                    'mime_in'  => 'The {field} must be a valid image format (PNG, JPEG).',
                    'ext_in'   => 'The {field} must have a valid extension (PNG, JPG).',
                    'is_image' => 'The {field} must be a valid image.',
                ],
            ],
        ]);

        if (!$doValid) {
            $msg = [
                'error' => [
                    'errorName' => $validation->getError('nameparts'),
                    'errorPrice' => $validation->getError('price'),
                    'errorSuite' => $validation->getError('suite'),
                    'errorIconUpload' => $validation->getError('iconUpload'),
                ]
            ];
        } else {
            $file_upload = $_FILES['iconUpload']['name'];
            $rowDataParts = $this->parts->find($id);

            if ($file_upload != NULL) {
                if ($rowDataParts && !empty($rowDataParts['iconUpload'])) {
                    $imagePath = $_SERVER['DOCUMENT_ROOT'] . $rowDataParts['iconUpload'];

                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $changedname = str_replace(' ', '-', $nameparts);
                $changedsuite = str_replace(' ', '-', $suite);
                $image_name = "$changedname-$changedsuite";
                $image_file = $this->request->getFile('iconUpload');
                $image_file->move('assets/upload/parts/', $image_name . '.' . $image_file->getExtension());

                $path_image = '/assets/upload/parts/' . $image_file->getName();
            } else {
                $path_image = $rowDataParts['icon'];
            }

            $this->parts->update($id, [
                'namaparts' => $nameparts,
                'price' => $price,
                'suite' => $suite,
                'icon' => $path_image
            ]);

            $msg = ['success' => 'Parts Successfully Added'];
        }

        echo json_encode($msg);
    }
}
