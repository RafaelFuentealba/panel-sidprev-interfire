<?php

namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\UsuarioSidprevModel;
use App\Models\InterfazModel;
use App\Libraries\Hash;

class Admin extends BaseController
{
    private $default_db;
    private $sidprev_oficial;
    private $sidprev_beta;

    public function __construct() {
        helper('Form');
        helper(['url', 'form']);
        $this->default_db = \Config\Database::connect('default');
        $this->sidprev_oficial = \Config\Database::connect('sidprev_oficial');
        $this->sidprev_beta = \Config\Database::connect('sidprev_beta');
    }

    function getActiveUser() {
        $userModel = new UsuarioModel($this->default_db);
        $loggedUser = session()->get('loggedUser');
        $userInfo = $userModel->where(['usuario_id' => $loggedUser, 'deleted' => false])->first();
        return $userInfo;
    }

    public function viewMyProfile() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $userData = ['userInfo' => $loggedUser];
            $response = ['userData' => $loggedUser];
            return view('admin/templates/principal-panel', $userData).view('admin/profile/view-profile', $response);
        }
    }

    public function editMyProfile() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $userData = ['userInfo' => $loggedUser];
            $response = ['userData' => $loggedUser];
            return view('admin/templates/principal-panel', $userData).view('admin/profile/edit-profile', $response);
        }
    }

    public function saveMyProfile() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser && !empty($_POST)) {
            $userModel = new UsuarioModel($this->db);

            $nombre = $this->request->getPost('usuario-nombre');
            $apellido = $this->request->getPost('usuario-apellido');

            $userToUpdate = $userModel->where('usuario_id', $loggedUser['usuario_id'])->first();
            $userToUpdate['nombre'] = $nombre;
            $userToUpdate['apellido'] = $apellido;
            $updatedUser = $userModel->update($loggedUser['usuario_id'], $userToUpdate);

            if (!$updatedUser) return $this->response->setJSON(0);
            else return $this->response->setJSON(1);
        }
    }

    public function changeMyPassword() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser && !empty($_POST)) {
            $userModel = new UsuarioModel($this->default_db);

            $oldPassword = $this->request->getPost('usuario-password');
            $newPassword = $this->request->getPost('usuario-new-password');
            
            $userToUpdate = $userModel->where('usuario_id', $loggedUser['usuario_id'])->first();
            if ($userToUpdate['deleted'] == 'f') {
                $checkOldPassword = Hash::check($oldPassword, $userToUpdate['clave']);
                if (!$checkOldPassword) {
                    return json_encode('La contraseña actual es incorrecta');
                } else {
                    $userToUpdate['clave'] = Hash::make($newPassword);
                    $updatedUser = $userModel->update($loggedUser['usuario_id'], $userToUpdate);
                    if (!$updatedUser) return $this->response->setJSON(0);
                    else return $this->response->setJSON(1);
                }
            }
        }
    }

    public function listAllUsers() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_oficial);
            $interfazModel = new InterfazModel($this->sidprev_oficial);
            $userData = ['userInfo' => $loggedUser];
            
            $getUsers = $usuariosModel->select('usuario_id, nombre, apellido, email, created_at, deleted')->findAll();
            if (!empty($getUsers)) {
                $activateUsers = $usuariosModel->where('deleted', false)->findAll();
                $blockUsers = $usuariosModel->where('deleted', true)->findAll();
                $getInterfaces = $interfazModel->select('interfaz_id')->findAll();
                $usersInfo = [
                    'users' => $getUsers,
                    'activateUsers' => $activateUsers,
                    'blockUsers' => $blockUsers,
                    'interfaces' => $getInterfaces
                ];
                return view('admin/templates/principal-panel', $userData).view('admin/users/all-users', $usersInfo);
            } else {
                return view('admin/templates/principal-panel', $userData).view('admin/templates/no-users');
            }
        }
    }
    
    public function listActiveUsers() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_oficial);
            $interfazModel = new InterfazModel($this->sidprev_oficial);
            $userData = ['userInfo' => $loggedUser];
            
            $getUsers = $usuariosModel->select('usuario_id, nombre, apellido, email, created_at, deleted')->where('deleted', false)->findAll();
            if (!empty($getUsers)) {
                $systemUsers = [];
                foreach ($getUsers as $user) {
                    $getInterfacesOfUser = $interfazModel->select('interfaz_id')->where('propietario_id', $user['usuario_id'])->findAll();
                    $getInterfacesOfUser = sizeof($getInterfacesOfUser);
                    $user['interfaces'] = $getInterfacesOfUser;
                    array_push($systemUsers, $user);
                }
                $usersInfo = ['users' => $systemUsers];
                return view('admin/templates/principal-panel', $userData).view('admin/users/active-users', $usersInfo);
            } else {
                return view('admin/templates/principal-panel', $userData).view('admin/templates/no-active-users');
            }
        }
    }

    public function listBlockUsers() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_oficial);
            $userData = ['userInfo' => $loggedUser];
            
            $getUsers = $usuariosModel->select('usuario_id, nombre, apellido, email, created_at, deleted')->where('deleted', true)->findAll();
            if (!empty($getUsers)) {
                $usersInfo = ['users' => $getUsers];
                return view('admin/templates/principal-panel', $userData).view('admin/users/block-users', $usersInfo);
            } else {
                return view('admin/templates/principal-panel', $userData).view('admin/templates/no-block-users');
            }
        }
    }

    public function activateUserById() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser && !empty($_POST)) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_oficial);
            $getID = $this->request->getPost('usuario-id');

            $getUser = $usuariosModel->where('usuario_id', $getID)->first();
            $getUser['deleted'] =  false;
            
            $userToUpdate = $usuariosModel->update($getUser['usuario_id'], $getUser);
            if (!$userToUpdate) return $this->response->setJSON(0);
            else return $this->response->setJSON(1);
        }
    }

    public function blockUserById() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser && !empty($_POST)) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_oficial);
            $getID = $this->request->getPost('usuario-id');

            $getUser = $usuariosModel->where('usuario_id', $getID)->first();
            $getUser['deleted'] =  true;
            
            $userToUpdate = $usuariosModel->update($getUser['usuario_id'], $getUser);
            if (!$userToUpdate) return $this->response->setJSON(0);
            else return $this->response->setJSON(1);
        }
    }

    public function viewUser($id = null) {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_oficial);
            $userData = ['userInfo' => $loggedUser];

            $getUser = $usuariosModel->where('usuario_id', $id)->first();
            $response = ['userData' => $getUser];

            if (!empty($getUser)) return view('admin/templates/principal-panel', $userData).view('admin/users/view-user', $response);
            else return view('admin/templates/principal-panel', $userData).view('admin/users/user-not-found');
        }
    }

    public function listAllBetaUsers() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_beta);
            $interfazModel = new InterfazModel($this->sidprev_beta);
            $userData = ['userInfo' => $loggedUser];
            
            $getUsers = $usuariosModel->select('usuario_id, nombre, apellido, email, created_at, deleted')->findAll();
            if (!empty($getUsers)) {
                $activateUsers = $usuariosModel->where('deleted', false)->findAll();
                $blockUsers = $usuariosModel->where('deleted', true)->findAll();
                $getInterfaces = $interfazModel->select('interfaz_id')->findAll();
                $usersInfo = [
                    'users' => $getUsers,
                    'activateUsers' => $activateUsers,
                    'blockUsers' => $blockUsers,
                    'interfaces' => $getInterfaces
                ];
                return view('admin/templates/principal-panel', $userData).view('admin/users/all-beta-users', $usersInfo);
            } else {
                return view('admin/templates/principal-panel', $userData).view('admin/templates/no-beta-users');
            }
        }
    }
    
    public function listActiveBetaUsers() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_beta);
            $interfazModel = new InterfazModel($this->sidprev_beta);
            $userData = ['userInfo' => $loggedUser];
            
            $getUsers = $usuariosModel->select('usuario_id, nombre, apellido, email, created_at, deleted')->where('deleted', false)->findAll();
            if (!empty($getUsers)) {
                $systemUsers = [];
                foreach ($getUsers as $user) {
                    $getInterfacesOfUser = $interfazModel->select('interfaz_id')->where('propietario_id', $user['usuario_id'])->findAll();
                    $getInterfacesOfUser = sizeof($getInterfacesOfUser);
                    $user['interfaces'] = $getInterfacesOfUser;
                    array_push($systemUsers, $user);
                }
                $usersInfo = ['users' => $systemUsers];
                return view('admin/templates/principal-panel', $userData).view('admin/users/active-beta-users', $usersInfo);
            } else {
                return view('admin/templates/principal-panel', $userData).view('admin/templates/no-active-beta-users');
            }
        }
    }

    public function listBlockBetaUsers() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_beta);
            $userData = ['userInfo' => $loggedUser];
            
            $getUsers = $usuariosModel->select('usuario_id, nombre, apellido, email, created_at, deleted')->where('deleted', true)->findAll();
            if (!empty($getUsers)) {
                $usersInfo = ['users' => $getUsers];
                return view('admin/templates/principal-panel', $userData).view('admin/users/block-beta-users', $usersInfo);
            } else {
                return view('admin/templates/principal-panel', $userData).view('admin/templates/no-block-beta-users');
            }
        }
    }

    public function activateBetaUserById() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser && !empty($_POST)) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_beta);
            $getID = $this->request->getPost('usuario-id');

            $getUser = $usuariosModel->where('usuario_id', $getID)->first();
            $getUser['deleted'] =  false;
            
            $userToUpdate = $usuariosModel->update($getUser['usuario_id'], $getUser);
            if (!$userToUpdate) return $this->response->setJSON(0);
            else return $this->response->setJSON(1);
        }
    }

    public function blockBetaUserById() {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser && !empty($_POST)) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_beta);
            $getID = $this->request->getPost('usuario-id');

            $getUser = $usuariosModel->where('usuario_id', $getID)->first();
            $getUser['deleted'] =  true;
            
            $userToUpdate = $usuariosModel->update($getUser['usuario_id'], $getUser);
            if (!$userToUpdate) return $this->response->setJSON(0);
            else return $this->response->setJSON(1);
        }
    }

    public function viewBetaUser($id = null) {
        $loggedUser = $this->getActiveUser();
        if ($loggedUser) {
            $usuariosModel = new UsuarioSidprevModel($this->sidprev_beta);
            $userData = ['userInfo' => $loggedUser];

            $getUser = $usuariosModel->where('usuario_id', $id)->first();
            $response = ['userData' => $getUser];

            if (!empty($getUser)) return view('admin/templates/principal-panel', $userData).view('admin/users/view-beta-user', $response);
            else return view('admin/templates/principal-panel', $userData).view('admin/users/beta-user-not-found');
        }
    }
}
