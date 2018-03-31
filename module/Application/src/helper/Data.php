<?php

namespace Application\helper;

class Data{

	public static function setData($data)
	{
		if (isset($data)) {
			return new \DateTime(Data::formatarData($data));
		} else {
			return NULL;
		}

	}

	private static function formatarData($data)
	{
		$formato = "d/m/Y";
		$dataObj = date_create_from_format($formato, $data);
		return date_format($dataObj, 'Y-m-d');
	}

	public static function dataToString($data)
	{
		if (!is_null($data)) {
			return $data->format('d/m/Y');
		} else {
			return '-';
		}

	}


}


?>