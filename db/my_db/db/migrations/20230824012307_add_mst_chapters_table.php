<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddMstChaptersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $table = $this->table('mst_chapters');
        $table->addColumn('comic_id', 'integer',['null' => false])
              ->addColumn('chapter_name', 'string',['null' => false])
              ->addColumn('date', 'datetime')
              ->create();
    }
    public function down()
    {
        $table = $this->table('mst_chapters');
        $table->drop()
              ->save();
    }  
}
