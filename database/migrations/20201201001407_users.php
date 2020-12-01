<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Users extends Migrator
{
    public function up()
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('avatar', 'string', ['null' => true, 'default'=>NULL, 'comment'=>'用户头像'])
            ->addColumn('god', 'boolean', ['default'=>FALSE, 'comment'=>'管理员'])
            ->addTimestamps('created_at', 'updated_at')
            ->addIndex('email', ['unique' => true])
            ->addIndex('god')
            ->create();
        }
    
    public function down()
    {
        $this->dropTable('users');
    }
}
