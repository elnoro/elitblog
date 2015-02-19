<?php

class m150219_164154_create_posts_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('Post', [
			'id' => 'pk',
			'author_id' => 'integer NOT NULL COMMENT "Автор"',
			'text' => 'text NOT NULL COMMENT "Текст"',
			'date' => 'date NOT NULL COMMENT "Дата публикации"',
		]);
		$this->addForeignKey('author_fk', 'Post', 'author_id', 'User', 'id', 'CASCADE', 'RESTRICT');
	}

	public function down()
	{
		$this->dropTable('Post');
	}
}