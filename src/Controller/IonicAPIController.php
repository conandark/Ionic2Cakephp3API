<?php

	namespace App\Controller;
    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;

    class IonicAPIController extends AppController
    {
		

		
		public function index()
		{
			// Now an instance of ArticlesTable.
			$Tblamphurs = TableRegistry::get('Tblamphur');
			$query = $Tblamphurs->find();

			$this->response->type('json');
			$this->response->body(json_encode($query));
			
			return $this->response;
		}

				
		public function add()
		{
			

			
			// Now an instance of ArticlesTable.
			$Tblamphurs = TableRegistry::get('Tblamphur');
			$data = json_decode(file_get_contents('php://input'));
			$Tblamphur = $Tblamphurs->newEntity();
			$Tblamphur->code = "002";
			$Tblamphur->name = "Name 002";
			//$Tblamphurs->save($Tblamphur);
	
			$this->response->type('json');
			$this->response->body(json_encode( $data ));
			return $this->response;
		}

		public function edit()
		{
				// Now an instance of ArticlesTable.
				$Tblamphurs = TableRegistry::get('Tblamphur');
				$data = json_decode(file_get_contents('php://input'));
				$Tblamphur = $Tblamphurs->newEntity();
				$Tblamphur->code = "002";
				$Tblamphur->name = "Name 002";
				//$Tblamphurs->save($Tblamphur);
		
				$this->response->type('json');
				$this->response->body(json_encode( $data ));
				return $this->response;
		}


		public function delete()
		{
				// Now an instance of ArticlesTable.
				$Tblamphurs = TableRegistry::get('Tblamphur');
				$data = json_decode(file_get_contents('php://input'));
				$Tblamphurs->delete($data->id);

				$this->response->type('json');
				$this->response->body(json_encode($data));
				return $this->response;
		}



    }
