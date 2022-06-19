<?php
namespace App\Repositories;
//Author:Ng Se Chian

use App\Models\Category;
class CategoryRepository implements CategoryInterface
{
	private $model;

	public function __construct(Category $model)
	{
		$this->model = $model; 
	}

	//To view all the data
	public function all()
	{
		return $this->model->get();
	}
	//Get an individual record
	public function get($id)
	{
		return $this->model->find($id);
	}

    public function findOrFail($id)
	{
		return $this->model->findOrFail($id);
	}

	//Store the data
	public function store(array $data)
	{
		return $this->model->create($data);
	}
	//Update the data
	public function update($id, array $data)
	{
		return $this->model->find($id)->update($data);
	}
	//Delete the data
	public function delete($id)
	{
		return $this->model->destroy($id);
	}
}
?>