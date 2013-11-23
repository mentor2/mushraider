<?php
class GamesController extends AdminAppController {
    public $components = array('Image');
    public $uses = array('Game', 'Dungeon', 'Classe', 'Race');

    var $paginate = array(
        'Game' => array(
            'limit' => 20,
            'recursive' => 1,
            'order' => array('title' => 'asc')
        )
    );

    var $adminOnly = true;

    function beforeFilter() {
        parent::beforeFilter();
    }

    public function index() {        
        $this->set('games', $this->paginate('Game'));
    }

    public function add() {
        if(!empty($this->request->data['Game'])) {
            $toSave = array();
            $toSave['title'] = $this->request->data['Game']['title'];
            $toSave['slug'] = $this->Tools->slugMe($toSave['title']);

            $imageName = $this->logo($this->request->data['Game']['logo']);
            if(!isset($imageName['error'])) {
                $toSave['logo'] = $imageName['name'];
                if($this->Game->save($toSave)) {
                    $gameId = $this->Game->getLastInsertId();
                    // Associate each new dungeons with the game
                    if(!empty($this->request->data['Game']['dungeons']['list'])) {
                        foreach($this->request->data['Game']['dungeons']['list'] as $dungeonId) {
                            $toSaveDungeons = array();
                            $toSaveDungeons['id'] = $dungeonId;
                            $toSaveDungeons['game_id'] = $gameId;
                            $this->Dungeon->save($toSaveDungeons);
                        }
                    }

                    // Associate each new classes with the game
                    if(!empty($this->request->data['Game']['classes']['list'])) {
                        foreach($this->request->data['Game']['classes']['list'] as $classeId) {
                            $toSaveClasses = array();
                            $toSaveClasses['id'] = $classeId;
                            $toSaveClasses['game_id'] = $gameId;
                            $this->Classe->save($toSaveClasses);
                        }
                    }

                    // Associate each new races with the game
                    if(!empty($this->request->data['Game']['races']['list'])) {
                        foreach($this->request->data['Game']['races']['list'] as $classeId) {
                            $toSaveRaces = array();
                            $toSaveRaces['id'] = $classeId;
                            $toSaveRaces['game_id'] = $gameId;
                            $this->Race->save($toSaveRaces);
                        }
                    }

                    $this->Session->setFlash(__('%s has been added to your games list', $toSave['title']), 'flash_success');
                    $this->redirect('/admin/games');
                }else {
                    $this->Session->setFlash(__('Something goes wrong'), 'flash_error');
                }
            }
        }


        $dungeonsList = $this->Dungeon->find('list', array('conditions' => array('game_id' => null), 'order' => 'title ASC'));
        $this->set('dungeonsList', $dungeonsList);

        $classesList = $this->Classe->find('list', array('conditions' => array('game_id' => null), 'order' => 'title ASC'));
        $this->set('classesList', $classesList);

        $racesList = $this->Race->find('list', array('conditions' => array('game_id' => null), 'order' => 'title ASC'));
        $this->set('racesList', $racesList);
    }

    public function edit($id = null) {
        if(!$id) {
            $this->redirect('/admin/games');
        }

        $params = array();
        $params['recursive'] = 1;
        $params['contain']['Classe'] = array();
        $params['contain']['Dungeon'] = array();
        $params['contain']['Race'] = array();        
        $params['conditions']['Game.id'] = $id;
        if(!$game = $this->Game->find('first', $params)) {
            $this->Session->setFlash(__('MushRaider is unable to find this game oO'), 'flash_error');
            $this->redirect('/admin/games');
        }

        $gameId = $id;
        if(!empty($this->request->data['Game']) && $this->request->data['Game']['id'] == $id) {
            $toSave = array();
            $toSave['id'] = $gameId;
            $toSave['title'] = $this->request->data['Game']['title'];
            $toSave['slug'] = $this->Tools->slugMe($toSave['title']);
            $imageName = $this->logo($this->request->data['Game']['logo']);
            if(!isset($imageName['error'])) {
                $toSave['logo'] = $imageName['name'];
                if($this->Game->save($toSave)) {
                    // Associate each dungeons with the game
                    if(!empty($this->request->data['Game']['dungeons']['list'])) {
                        foreach($this->request->data['Game']['dungeons']['list'] as $dungeonId) {
                            $toSaveDungeons = array();
                            $toSaveDungeons['id'] = $dungeonId;
                            $toSaveDungeons['game_id'] = $gameId;
                            $this->Dungeon->save($toSaveDungeons);
                        }
                    }

                    // Associate each classes with the game
                    if(!empty($this->request->data['Game']['classes']['list'])) {
                        foreach($this->request->data['Game']['classes']['list'] as $classeId) {
                            $toSaveClasses = array();
                            $toSaveClasses['id'] = $classeId;
                            $toSaveClasses['game_id'] = $gameId;
                            $this->Classe->save($toSaveClasses);
                        }
                    }

                    // Associate each races with the game
                    if(!empty($this->request->data['Game']['races']['list'])) {
                        foreach($this->request->data['Game']['races']['list'] as $classeId) {
                            $toSaveRaces = array();
                            $toSaveRaces['id'] = $classeId;
                            $toSaveRaces['game_id'] = $gameId;
                            $this->Race->save($toSaveRaces);
                        }
                    }

                    $this->Session->setFlash(__('The game %s has been updated', $toSave['title']), 'flash_success');
                    $this->redirect('/admin/games');
                }else {
                    $this->Session->setFlash(__('Something goes wrong'), 'flash_error');
                }
            }

            $game['Game'] = array_merge($game['Game'], $this->request->data['Game']);
        }

        $dungeonsList = $this->Dungeon->find('list', array('conditions' => array('game_id' => null), 'order' => 'title ASC'));
        $this->set('dungeonsList', $dungeonsList);

        $classesList = $this->Classe->find('list', array('conditions' => array('game_id' => null), 'order' => 'title ASC'));
        $this->set('classesList', $classesList);

        $racesList = $this->Race->find('list', array('conditions' => array('game_id' => null), 'order' => 'title ASC'));
        $this->set('racesList', $racesList);


        $this->request->data = array_merge($game, $this->request->data);        
    }

    private function logo($image) {
        $return = array();
        if(!$image['error']) {
            $imageName = 'game_'.$image['name'];
            $this->Image->resize($image['tmp_name'], 'files/logos', $imageName, 64, 64);
            $return['name'] = $imageName;
        }else {            
            switch($image['error']) {
                case 1:
                case 2:
                    $error = __('Logo is too big');
                    break;
                case 3:
                    $error = __('An error occur while uploading');
                    break;
            }
            if(!empty($error)) {
                $this->Session->setFlash($error, 'flash_error');  
                $return['error'] = true;
            }
        }

        return $return;
    }
}