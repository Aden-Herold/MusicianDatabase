<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class MusicianController extends AppController
{

    var $uses = array('Musician', 'Instrument');

    public function login() {
        if ($this->request->is('post')) {
            $musician = $this->Auth->identify();
            if ($musician) {
                $this->Auth->setUser($musician);
                echo $musician->username;
                $path = '/';
                echo $path;
                $this->redirect($path);
            } else {
                $this->redirect('/');
                $this->Flash->error(
                    __('Username or password is incorrect'),
                    'default',
                    [],
                    'auth'
                );
            }
        }
    }

    public function logout() {
        if ($this->request->is('post')) {
            $this->Auth->logout();
            $this->redirect('/');
        }
    }

    public function index() {
        $this->paginate = [
            'contain' => ['Band']
        ];
        $this->set('musician', $this->paginate($this->Musician));
        $this->set('_serialize', ['musician']);
    }

    public function home() {
        $this->paginate = [
            'contain' => ['Band']
        ];
        $this->set('musician', $this->paginate($this->Musician));
        $this->set('_serialize', ['musician']);
        $this->loadModel('Band');
        $this->set('band', $this->Band->find('all'));  
    }

    public function view($id = null) {
        $musician = $this->Musician->get($id, [
            'contain' => ['Band']
        ]);
        $this->loadModel('Band');
        $this->set('band', $this->Band->find('all'));
        $this->set('musician', $musician);
        $this->loadModel('Instrument');
        $this->set('instrument', $this->Instrument->find('all'));  
        $this->set('_serialize', ['musician']);
    }

    public function register() {
        $musician = $this->Musician->newEntity();
        if ($this->request->is('post')) {
            $musician = $this->Musician->patchEntity($musician, $this->request->data);
            if ($this->Musician->save($musician)) {
                $this->Flash->success(__('Your account has been created. Redirecting to user profile.'));
                $this->Auth->setUser($musician->toArray());
                return $this->redirect([
                    'controller' => 'Musician',
                    'action' => 'edit'
                ]);
            } else {
                $this->Flash->error(__('Your account could not be created.'));
            }
        }
        $band = $this->Musician->Band->find('list', ['limit' => 200]);
        $this->set(compact('musician', 'band'));
        $this->set('_serialize', ['musician']);
    }

    public function edit($id = null) {
        if($this->request->session()->read('Auth.User.username') == "admin") {
            $musician = $this->Musician->get($id);
        } else {
            $musician = $this->Musician->get($this->request->session()->read('Auth.User.username'), [
                'contain' => []
            ]);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $musician = $this->Musician->patchEntity($musician, $this->request->data);
            $this->addPicture($musician);
            if ($this->Musician->save($musician)) {
                $this->Flash->success(__('Your profile settings have been saved!'));
                return $this->redirect(['action' => '../musician/view/', $musician->username]);
            } else {
                $this->Flash->error(__('Your profile settings could not be saved. Try again.'));
            }
        }
        $band = $this->Musician->Band->find('list', ['limit' => 200]);
        $this->set(compact('musician', 'band'));
        $this->set('_serialize', ['musician']);
    }


    public function addPicture($musician = null) {

        if(!empty($this->request->data)) {
            if(!empty($this->request->data['fileToUpload'])) {
                $file = $this->request->data['fileToUpload'];

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif'); 

                if(in_array($ext, $arr_ext)) {
                    $path = WWW_ROOT . 'img/uploads/users/' . $musician['username'] . '/';
                    $this->log($path, 'debug');
                    $folder = new Folder($path, true, 0755);
                    move_uploaded_file($file['tmp_name'], $path . '/' . $file['name']);
                    $musician['portrait'] = $file['name'];
                }
            }
        }

        if ($this->Musician->save($musician)) {
            $this->Flash->success(__('Image succesfully uploaded'));
            return $this->redirect(['action' => '../musician/view/', $musician->username]);
        } else {
            $this->Flash->error(__('Your image could not be uploaded.'));
        }
    }

    public function delete($id = null) {
        if($this->request->session()->read('Auth.User.username') == "admin" || $this->request->session()->read('Auth.User.username') == $id) {
            if($musician->band_id != "") {
                $this->request->allowMethod(['post', 'delete']);
                $musician = $this->Musician->get($id);
                if ($this->Musician->delete($musician)) {
                    $this->Flash->success(__('The musician has been deleted.'));
                } else {
                    $this->Flash->error(__('The musician could not be deleted. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('You need to delete your band first!'));
                return $this->redirect(['action' => 'index']);
            }
        } else {
            $this->Flash->error(__('You are not authorized to delete this musician!'));
            return $this->redirect(['action' => 'index']);
        }
    }
}