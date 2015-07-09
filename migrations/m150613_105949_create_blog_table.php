<?php

use yii\db\Schema;
use yii\db\Migration;

class m150613_105949_create_blog_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';


            $this->createTable('{{%blog}}', [
                'id' => Schema::TYPE_PK,
                'category_id' => Schema::TYPE_INTEGER . '(10) NULL DEFAULT NULL',
                'user_id' => Schema::TYPE_INTEGER . '(10) NULL DEFAULT NULL',
                'tags_id' => Schema::TYPE_INTEGER . '(10)NULL DEFAULT NULL',
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'slug' => Schema::TYPE_STRING . ' NOT NULL',
                'text' => Schema::TYPE_TEXT,
                'prev_img' => Schema::TYPE_STRING . ' NOT NULL',
                'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

            $this->createTable('{{%category}}', [
                'id' => Schema::TYPE_PK,
                'parent_id' => Schema::TYPE_INTEGER . '(10)NOT NULL DEFAULT 0',
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'slug' => Schema::TYPE_STRING . ' NOT NULL',
                'prev_img' => Schema::TYPE_STRING . ' NOT NULL',
                'order' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
                'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);

            $this->createTable('{{%tags}}', [
                'id' => Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING . ' NOT NULL',
                'slug' => Schema::TYPE_STRING . ' NOT NULL',
                'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
                'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);


            $this->createIndex('idx_category_id', '{{%blog}}', 'category_id');
            $this->createIndex('idx_user_id', '{{%blog}}', 'user_id');
            $this->createIndex('idx_tags_id', '{{%blog}}', 'tags_id');
            $this->createIndex('idx_blog_status', '{{%blog}', 'status');
            $this->createIndex('idx_blog_slug', '{{%blog}', 'slug');


            $this->createIndex('idx_parent_id', '{{%category}}', 'parent_id');
            $this->createIndex('idx_parent_status', '{{%category}}', 'status');
            $this->createIndex('idx_title', '{{%category}}', 'title');
            $this->createIndex('idx_slug', '{{%category}}', 'slug');


            $this->createIndex('idx_title', '{{%tags}}', 'title');
            $this->createIndex('idx_slug', '{{%tags}}', 'slug');
            $this->createIndex('idx_status', '{{%tags}}', 'status');

            $this->addForeignKey('fk_category_blog_id', '{{%blog}}', 'category_id', '{{%category}}',  'id', 'RESTRICT', 'RESTRICT');
         //   $this->addForeignKey('fk_user_blog_id', '{{%blog}}', 'user_id', '{{%user}}',  'id', 'CASCADE', 'RESTRICT');
            $this->addForeignKey('fk_slug_blog', '{{%blog}}', 'slug_id', '{{%slug}}',  'id', 'RESTRICT', 'RESTRICT');
        }
    }

    public function safeDown()
    {
        $this->dropPrimaryKey('fk_category_blog_id', '{{%blog}}');
        $this->dropPrimaryKey('fk_user_blog_id', '{{%blog}}');
        $this->dropPrimaryKey('fk_slug_blog', '{{%blog}}');

        $this->dropTable('{{%blog}}');
        $this->dropTable('{{%category}}');
    }

}
