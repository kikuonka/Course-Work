<?php
	namespace Core;
	
	class Model
	{
		private static $link;
		
		public function __construct()
		{
			if (!self::$link) {
				self::$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				mysqli_query(self::$link, "SET NAMES 'utf8'");
			}
		}
		
		protected function findOne($query)
		{
			$result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
			return mysqli_fetch_assoc($result);
		}
		
		protected function findMany($query)
		{
			$result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
			for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
			
			return $data;
		}

		protected function addOne($query)
        {
            $result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
			return mysqli_insert_id(self::$link);
        }

		protected function getSave($var)
		{
			return mysqli_real_escape_string(self::$link, $var);
		}

		protected function getId()
		{
			return mysqli_insert_id(self::$link);
		}

		protected function deleteOne($query) {
			$result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
		}

		protected function updateOne($query) {
			$result = mysqli_query(self::$link, $query) or die(mysqli_error(self::$link));
		}
	}