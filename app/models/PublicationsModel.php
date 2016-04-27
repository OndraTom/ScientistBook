<?php

namespace App\Models;

class PublicationsModel extends BaseModel
{
	protected $tableName = 'publications';


	protected function getPublicationTypes()
	{
		return $this->connection->table('publication_types');
	}


	public function getPublicationTypesList()
	{
		$list = [];

		foreach ($this->getPublicationTypes() as $type)
		{
			$list[$type->id] = $type->title;
		}

		return $list;
	}
}