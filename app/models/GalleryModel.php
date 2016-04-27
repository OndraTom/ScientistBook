<?php

namespace App\Models;

use Nette\Http\FileUpload;
use DirectoryIterator;
use Exception;

class GalleryModel extends BaseModel
{
	/**
	 * Gallery max size in bytes.
	 */
	const GALLERY_MAX_SIZE = 10000000;


	protected $tableName = 'photos';


	protected $galleriesDir = __DIR__ . '/../../www/galleries/';


	protected function createGalleryDir($galleryDir)
	{
		if (!file_exists($galleryDir))
		{
			if (mkdir($galleryDir) === false)
			{
				throw new Exception('Creation of gallery dir failed.');
			}
		}
	}


	protected function getGallerySize($galleryDir)
	{
		$size = 0;

		foreach (new DirectoryIterator($galleryDir) as $file)
		{
			$size += $file->getSize();
		}

		return $size;
	}


	protected function isGallerySizeExceeded($gallerySize)
	{
		return $gallerySize > self::GALLERY_MAX_SIZE;
	}


	protected function uploadPhoto($userId, $galleryDir, FileUpload $photo)
	{
		$fileExtension	= pathinfo($photo->getName(), PATHINFO_EXTENSION);
		$photoName		= uniqid('photo_') . '.' . $fileExtension;
		$photoPath		= $galleryDir . $photoName;

		if (copy($photo->getTemporaryFile(), $photoPath) === false)
		{
			throw new Exception('Photo upload failed.');
		}

		$this->insert([
			'user_id'	=> $userId,
			'name'		=> $photoName,
			'path'		=> $photoPath
		]);
	}


	/**
	 *
	 * @param	int				$userId
	 * @param	FileUpload[]	$photos
	 * @throws	Exception
	 */
	public function uploadPhotos($userId, array $photos)
	{
		$galleryDir	= $this->galleriesDir . $userId . '/';

		$this->createGalleryDir($galleryDir);

		$gallerySize = $this->getGallerySize($galleryDir);

		foreach ($photos as $photo)
		{
			$gallerySize += $photo->getSize();

			if ($this->isGallerySizeExceeded($gallerySize))
			{
				throw new Exception('There is not enough space in gallery for this upload.');
			}

			$this->uploadPhoto($userId, $galleryDir, $photo);
		}
	}


	public function deletePhoto($userId, $id)
	{
		$photo = $this->findBy([
			'user_id'	=> $userId,
			'id'		=> $id
		])->fetch();

		if (!$photo)
		{
			throw new Exception('Cannot delete photo. It not exists or it is not yours.');
		}

		if (unlink($photo->path) === false)
		{
			throw new Exception('Deletion of photo failed.');
		}

		$this->delete($id);
	}
}