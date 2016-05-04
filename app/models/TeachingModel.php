<?php

namespace App\Models;

class TeachingModel extends BaseModel
{
	protected $tableName = 'teaching';
	
	
	public function getCurrentTeaching($userId)
	{
		return $this->getAll()->where(['user_id' => $userId, 'year_to' => null])->order('year_from DESC');
	}
	
	
	public function getHistoryTeaching($userId)
	{
		return $this->getAll()->where('user_id = ? AND year_to IS NOT NULL', $userId)->order('year_from DESC');
	}
}