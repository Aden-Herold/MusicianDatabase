<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


class InstrumentController extends AppController {

    public function index()
    {
        $this->paginate = [
            'contain' => ['Musician']
        ];
        $this->set('instrument', $this->paginate($this->Instrument));
        $this->set('_serialize', ['instrument']);
    }

    public function view($id = null)
    {
        $instrument = $this->Instrument->get($id, [
            'contain' => ['Musician']
        ]);
        $this->set('instrument', $instrument);
        $this->set('_serialize', ['instrument']);
    }

    public function add()
    {
        $instrument = $this->Instrument->newEntity();
        if ($this->request->is('post')) {
            $instrument = $this->Instrument->patchEntity($instrument, $this->request->data);
            if ($this->Instrument->save($instrument)) {
                $this->Flash->success(__('The instrument has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
            }
        }
        $musician = $this->request->session()->read('Auth.User.username');
        $this->set(compact('instrument', 'musician'));
        $this->set('_serialize', ['instrument']);
    }

    public function edit($id = null) {
        $instrument = $this->Instrument->get($id, [
            'contain' => []
        ]);
        if($this->request->session()->read('Auth.User.username') == "admin" || $instrument->user_id == $this->request->session()->read('Auth.User.username')) {
            if ($this->request->is(['patch', 'post', 'put'])) {
                $instrument = $this->Instrument->patchEntity($instrument, $this->request->data);
                $this->addPicture($instrument);
                if ($this->Instrument->save($instrument)) {
                    $this->Flash->success(__('The instrument has been saved.'));
                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('The instrument could not be saved. Please, try again.'));
                }
            }
            $musician = $this->request->session()->read('Auth.User.username');
            $this->set(compact('instrument', 'musician'));
            $this->set('_serialize', ['instrument']);
        } else {
            $this->Flash->error(__('You are not authorized to edit this instrument.'));
            return $this->redirect(['action' => 'index']);
        }
    }

    public function addPicture($instrument = null) {

        if(!empty($this->request->data)) {
            if(!empty($this->request->data['fileToUpload'])) {
                $file = $this->request->data['fileToUpload'];

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif'); 

                if(in_array($ext, $arr_ext)) {
                    $path = WWW_ROOT . 'img/uploads/instruments/' . $instrument['id'] . '/';
                    $this->log($path, 'debug');
                    $folder = new Folder($path, true, 0755);
                    move_uploaded_file($file['tmp_name'], $path . '/' . $file['name']);
                    $instrument['portrait'] = $file['name'];
                }
            }
        }

        if ($this->Instrument->save($instrument)) {
            $this->Flash->success(__('Image succesfully uploaded'));
            return $this->redirect(['action' => '../instrument/view/', $instrument->id]);
        } else {
            $this->Flash->error(__('Your image could not be uploaded.'));
        }
    }

    public function delete($id = null) {
        $instrument = $this->Instrument->get($id);
        if($this->request->session()->read('Auth.User.username') == "admin" || $this->request->session()->read('Auth.User.username') == $instrument->user_id) {
            $this->request->allowMethod(['post', 'delete']);
            if ($this->Instrument->delete($instrument)) {
                $this->Flash->success(__('The instrument has been deleted.'));
                } else {
                    $this->Flash->error(__('The instrument could not be deleted. Please, try again.'));
                }
                return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('You are not authorized to delete this instrument!'));
            return $this->redirect(['action' => 'index']);
        }
    }
}
