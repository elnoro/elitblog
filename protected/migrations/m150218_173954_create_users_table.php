<?php

class m150218_173954_create_users_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('User', [
			'id' => 'pk',
			'first_name' => 'string NOT NULL COMMENT "Имя"',
			'second_name' => 'string NOT NULL COMMENT "Фамилия"',
			'login' => 'string NOT NULL COMMENT "Логин"',
			'password' => 'string NOT NULL COMMENT "Пароль"',
		]);
		$this->insert('User', [
			'first_name' => 'Админ',
			'second_name' => 'Админ',
			'login' => 'admin',
			'password' => password_hash('admin', PASSWORD_DEFAULT),
		]);
	}

	public function down()
	{
		$this->dropTable('User');
	}
}