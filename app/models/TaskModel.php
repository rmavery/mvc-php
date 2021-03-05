<?php

/**
 * TaskModel
 */
class TaskModel extends Model {

	/**
	 * Table name
	 * @var string
	 */
	protected static $tableName = 'tasks';

	/**
	 * Restore all rows from the table - INNER JOIN with the table `users`
	 * @return array
	 */
	public static function getAllFromInnerJoinWithUsers() {
		$tasks = sprintf('`%s`', self::getTableName());
		$users = sprintf('`%s`', UserModel::getTableName());

		/**
		 * The order of the tables in the SELECT row is important because we want the `id` field from the` tasks` table to override the `id` field from the` users` table
		 */
		$sql = <<<END
		SELECT $tasks.*, $users.`first_name`, $users.`last_name`
		FROM $tasks INNER JOIN $users
		ON $tasks.`user_id` = $users.`id`;
		END;

		$pst = DB::getInstance()->prepare($sql);
		$pst->execute();

		return $pst->fetchAll();
	}

}
