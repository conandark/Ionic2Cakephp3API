<?php

	namespace App\Controller;
    use App\Controller\AppController;
    use Cake\ORM\TableRegistry;

    class IonicAPIController extends AppController
    {
		
		public function getData()
		{
			// Now an instance of DiaryTable.
			$DiaryTable = TableRegistry::get('Diary');
			$query = $DiaryTable->find();
			$this->response->type('json');
			$this->response->body(json_encode($query));
			return $this->response;
		}

				
		public function addData()
		{
			// Now an instance of DiaryTable.
			$DiaryTable = TableRegistry::get('Diary');
			$data = json_decode(file_get_contents('php://input'));
			$Diary = $DiaryTable->newEntity();
			$Diary->title = $data->title;
			$Diary->detail = $data->detail;

			if(isset($data->image64) && !empty($data->image64)){
				$fileName = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')) . ".jpg";
				$output_file = "uploads/diary/".$fileName;
				if(file_put_contents($output_file, base64_decode($data->image64))){
					$Diary->image = $output_file;
				}
			}

			$DiaryTable->save($Diary);

			$this->response->type('json');
			$this->response->body(json_encode($Diary));
			return $this->response;
		}

		public function editData()
		{
			// Now an instance of DiaryTable.
			$DiaryTable = TableRegistry::get('Diary');
			$data = json_decode(file_get_contents('php://input'));
			$Diary = $DiaryTable->newEntity();
			$Diary->diary_id = $data->diary_id;
			$Diary->title = $data->title ;
			$Diary->detail = $data->detail ;



			if(isset($data->image64) && !empty($data->image64)){
				$fileName = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y')) . ".jpg";
				$output_file = "uploads/diary/".$fileName;
				if(file_put_contents($output_file, base64_decode($data->image64))){
					if(!empty($Diary->image)){
						unlink($Diary->image);
					}
					$Diary->image = $output_file;
				}
			}


			$DiaryTable->save($Diary);
	
			$this->response->type('json');
			$this->response->body(json_encode($Diary));
			return $this->response;
		}


		public function deleteData()
		{
			// Now an instance of DiaryTable.
			$DiaryTable = TableRegistry::get('Diary');
			$data = json_decode(file_get_contents('php://input'));
			$DiaryTable->delete($data->diary_id);

			$this->response->type('json');
			$this->response->body(json_encode($data));
			return $this->response;
		}


    }
