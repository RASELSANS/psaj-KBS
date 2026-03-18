<?php

namespace App\Controllers\Admin;

use App\Models\Doctor;
use App\Models\DoctorSpesialis;
use App\Models\DoctorPoli;

class DoctorController extends AdminController
{
    protected $doctorModel;
    protected $doctorSpesialisModel;
    protected $doctorPoliModel;

    public function __construct()
    {
        parent::__construct();
        $this->doctorModel = new Doctor();
        $this->doctorSpesialisModel = new DoctorSpesialis();
        $this->doctorPoliModel = new DoctorPoli();
    }

    /**
     * Get list of all doctors
     */
    public function index()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $page = (int)($this->request->getGet('page') ?? 1);
        $search = $this->request->getGet('search') ?? '';
        $limit = 10;
        $offset = ($page - 1) * $limit;

        // Build query with search
        $builder = $this->doctorModel->builder();
        
        if ($search) {
            $builder->like('nama_doctor', $search);
        }

        // Get total count
        $total = $builder->countAllResults(false);

        // Get doctors with pagination
        $doctors = $builder->limit($limit, $offset)
                        ->get()
                        ->getResultArray();

        // Add relations
        foreach ($doctors as &$doctor) {
            $doctor['spesialis'] = $this->doctorModel->getSpesialis($doctor['id_doctor']);
            $doctor['poli'] = $this->doctorModel->getPoli($doctor['id_doctor']);
            $doctor['jadwal'] = $this->doctorModel->getJadwal($doctor['id_doctor']);
        }

        return $this->successResponse([
            'doctors' => $doctors,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'total_pages' => ceil($total / $limit),
            ],
        ]);
    }

    /**
     * Get single doctor
     */
    public function show($id_doctor)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $doctor = $this->doctorModel->find($id_doctor);
        if (!$doctor) {
            return $this->errorResponse(['doctor' => 'Dokter tidak ditemukan'], 404);
        }

        $doctor['spesialis'] = $this->doctorModel->getSpesialis($id_doctor);
        $doctor['poli'] = $this->doctorModel->getPoli($id_doctor);

        return $this->successResponse($doctor);
    }

    /**
     * Create new doctor
     */
    public function create()
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $nama_doctor = $this->request->getPost('nama_doctor');
        $profil = $this->request->getPost('profil');
        $foto = $this->request->getFile('foto');
        $galleryImage = $this->request->getPost('gallery_image');
        $id_spesialis = $this->request->getPost('id_spesialis'); // array
        $id_poli = $this->request->getPost('id_poli'); // array

        // Validation
        $errors = [];
        if (!$nama_doctor) $errors['nama_doctor'] = 'Nama dokter harus diisi';
        if (!$profil) $errors['profil'] = 'Profil harus diisi';

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        // Handle file upload or gallery image
        $fotoName = null;
        
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Upload new file
            if ($foto->getSize() > 2097152) { // 2MB
                return $this->validationErrorResponse(['foto' => 'Ukuran foto maksimal 2MB']);
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($foto->getMimeType(), $allowedTypes)) {
                return $this->validationErrorResponse(['foto' => 'Tipe file harus JPG, PNG, atau GIF']);
            }

            $newName = $foto->getRandomName();
            $foto->move('uploads/doctors', $newName);
            $fotoName = $newName;
        } elseif ($galleryImage) {
            // Copy from gallery
            $sourcePath = FCPATH . 'uploads/' . $galleryImage;
            
            if (file_exists($sourcePath)) {
                $newName = time() . '_' . basename($galleryImage);
                $destPath = FCPATH . 'uploads/doctors/' . $newName;
                
                if (copy($sourcePath, $destPath)) {
                    $fotoName = $newName;
                } else {
                    return $this->validationErrorResponse(['foto' => 'Gagal menyalin foto dari galeri']);
                }
            } else {
                return $this->validationErrorResponse(['foto' => 'Foto galeri tidak ditemukan']);
            }
        }

        // Create doctor
        $doctorData = [
            'nama_doctor' => $nama_doctor,
            'profil' => $profil,
            'foto' => $fotoName,
        ];

        $id_doctor = $this->doctorModel->insert($doctorData);

        // Create doctor spesialis relations
        if ($id_spesialis) {
            foreach ($id_spesialis as $spesialis_id) {
                $this->doctorSpesialisModel->insert([
                    'id_doctor' => $id_doctor,
                    'id_spesialis' => $spesialis_id,
                ]);
            }
        }

        // Create doctor poli relations
        if ($id_poli) {
            foreach ($id_poli as $poli_id) {
                $this->doctorPoliModel->insert([
                    'id_doctor' => $id_doctor,
                    'id_poli' => $poli_id,
                ]);
            }
        }

        $doctor = $this->doctorModel->find($id_doctor);
        $doctor['spesialis'] = $this->doctorModel->getSpesialis($id_doctor);
        $doctor['poli'] = $this->doctorModel->getPoli($id_doctor);

        return $this->successResponse($doctor, 'Dokter berhasil ditambahkan', 201);
    }

    /**
     * Update doctor
     */
    public function update($id_doctor)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $doctor = $this->doctorModel->find($id_doctor);
        if (!$doctor) {
            return $this->errorResponse(['doctor' => 'Dokter tidak ditemukan'], 404);
        }

        $nama_doctor = $this->request->getPost('nama_doctor');
        $profil = $this->request->getPost('profil');
        $foto = $this->request->getFile('foto');
        $galleryImage = $this->request->getPost('gallery_image');
        $id_spesialis = $this->request->getPost('id_spesialis');
        $id_poli = $this->request->getPost('id_poli');

        // Validation
        $errors = [];
        if (!$nama_doctor) $errors['nama_doctor'] = 'Nama dokter harus diisi';
        if (!$profil) $errors['profil'] = 'Profil harus diisi';

        if ($errors) {
            return $this->validationErrorResponse($errors);
        }

        $updateData = [
            'nama_doctor' => $nama_doctor,
            'profil' => $profil,
        ];

        // Handle file upload or gallery image
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Upload new file
            if ($foto->getSize() > 2097152) {
                return $this->validationErrorResponse(['foto' => 'Ukuran foto maksimal 2MB']);
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($foto->getMimeType(), $allowedTypes)) {
                return $this->validationErrorResponse(['foto' => 'Tipe file harus JPG, PNG, atau GIF']);
            }

            // Delete old photo
            if ($doctor['foto']) {
                $oldPath = 'uploads/doctors/' . $doctor['foto'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $newName = $foto->getRandomName();
            $foto->move('uploads/doctors', $newName);
            $updateData['foto'] = $newName;
        } elseif ($galleryImage) {
            // Copy from gallery
            $sourcePath = FCPATH . 'uploads/' . $galleryImage;
            
            if (file_exists($sourcePath)) {
                // Delete old photo
                if ($doctor['foto']) {
                    $oldPath = 'uploads/doctors/' . $doctor['foto'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                
                $newName = time() . '_' . basename($galleryImage);
                $destPath = FCPATH . 'uploads/doctors/' . $newName;
                
                if (copy($sourcePath, $destPath)) {
                    $updateData['foto'] = $newName;
                } else {
                    return $this->validationErrorResponse(['foto' => 'Gagal menyalin foto dari galeri']);
                }
            } else {
                return $this->validationErrorResponse(['foto' => 'Foto galeri tidak ditemukan']);
            }
        }

        $this->doctorModel->update($id_doctor, $updateData);

        // Update spesialis relations
        if ($id_spesialis !== null) {
            $this->doctorSpesialisModel->where('id_doctor', $id_doctor)->delete();
            foreach ($id_spesialis as $spesialis_id) {
                $this->doctorSpesialisModel->insert([
                    'id_doctor' => $id_doctor,
                    'id_spesialis' => $spesialis_id,
                ]);
            }
        }

        // Update poli relations
        if ($id_poli !== null) {
            $this->doctorPoliModel->where('id_doctor', $id_doctor)->delete();
            foreach ($id_poli as $poli_id) {
                $this->doctorPoliModel->insert([
                    'id_doctor' => $id_doctor,
                    'id_poli' => $poli_id,
                ]);
            }
        }

        $doctor = $this->doctorModel->find($id_doctor);
        $doctor['spesialis'] = $this->doctorModel->getSpesialis($id_doctor);
        $doctor['poli'] = $this->doctorModel->getPoli($id_doctor);

        return $this->successResponse($doctor);
    }

    /**
     * Delete doctor
     */
    public function delete($id_doctor)
    {
        $authCheck = $this->requireLogin();
        if ($authCheck) return $authCheck;

        $doctor = $this->doctorModel->find($id_doctor);
        if (!$doctor) {
            return $this->errorResponse(['doctor' => 'Dokter tidak ditemukan'], 404);
        }

        // Delete photo
        if ($doctor['foto']) {
            $path = 'uploads/doctors/' . $doctor['foto'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Delete relations (cascade handled by database)
        $this->doctorModel->delete($id_doctor);

        return $this->successResponse(null);
    }
}
