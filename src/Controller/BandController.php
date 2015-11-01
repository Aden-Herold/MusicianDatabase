<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class BandController extends AppController {


    public function index() {
        $this->set('band', $this->paginate($this->Band));
        $this->set('_serialize', ['band']);

        $this->loadModel('Musician');
        $this->set('musician', $this->Musician->find('all'));
        $this->set('currentMusician', $this->Musician->find('list', [
            'username' => $this->request->session()->read('Auth.User.username')
            ]));
    }

    public function view($id = null) {
        $band = $this->Band->get($id, [
            'contain' => ['Musician']
        ]);
        $this->set('band', $band);
        $this->loadModel('Musician');
        $this->set('musician', $this->Musician->find('all'));  
        $this->set('_serialize', ['band']);
    }

    public function add() {
        $band = $this->Band->newEntity();
        if ($this->request->is('post')) {
            $band = $this->Band->patchEntity($band, $this->request->data);
            if ($this->Band->save($band)) {
                $this->Flash->success(__('The band has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The band could not be saved. Please, try again.'));
            }
        }
        $musician = $this->request->session()->read('Auth.User.username');
        $this->set(compact('band'));
        $this->set('_serialize', ['band']);
    }

    public function edit($id = null) {
        $band = $this->Band->get($id, [
            'contain' => []
        ]);
        if($this->request->session()->read('Auth.User.username') == "admin" || $band->user_id == $this->request->session()->read('Auth.User.username')) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $band = $this->Band->patchEntity($band, $this->request->data);
                $this->addPicture($band);
                if ($this->Band->save($band)) {
                    $this->Flash->success(__('The band has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The band could not be saved. Please, try again.'));
                }
            }
            $this->set(compact('band'));
            $this->set('_serialize', ['band']);
        } else {
            $this->Flash->error(__('You are not authorized to edit this band.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function addPicture($band = null) {

        if(!empty($this->request->data)) {
            if(!empty($this->request->data['fileToUpload'])) {
                $file = $this->request->data['fileToUpload'];

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif'); 

                if(in_array($ext, $arr_ext)) {
                    $path = WWW_ROOT . 'img/uploads/bands/' . $band['id'] . '/';
                    $this->log($path, 'debug');
                    $folder = new Folder($path, true, 0755);
                    move_uploaded_file($file['tmp_name'], $path . '/' . $file['name']);
                    $band['logo'] = $file['name'];
                }
            }
        }

        if ($this->Band->save($band)) {
            $this->Flash->success(__('Image succesfully uploaded'));
            return $this->redirect(['action' => '../Band/view/', $band->id]);
        } else {
            $this->Flash->error(__('Your image could not be uploaded.'));
        }
    }


    public function join($id = null) {
        $this->loadModel('Musician');

        $musician = $this->Musician->get($this->request->session()->read('Auth.User.username'), [
            'contain' => []
        ]);

        $band = $this->Band->get($id);

        $musician['band_id'] = $id;


        if ($this->Musician->save($musician)) {
            $this->Flash->success(__('The band is added to your profile'));
            return $this->redirect(['action' => '../musician/view/'.$musician->username]);
        } else {
            $this->Flash->error(__('Message'));
        }
    }

    public function delete($id = null) {
        $band = $this->Band->get($id);
        if($this->request->session()->read('Auth.User.username') == "admin" || $this->request->session()->read('Auth.User.username') == $band->user_id) {
            $this->request->allowMethod(['post', 'delete']);
            if ($this->Band->delete($band)) {
                $this->Flash->success(__('The band has been deleted.'));
            } else {
                $this->Flash->error(__('The band could not be deleted. Please, try again.'));
            }
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('You are not authorized to delete this band!'));
            return $this->redirect(['action' => 'index']);
        }
    }

}
