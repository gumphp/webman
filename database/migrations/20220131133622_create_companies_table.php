<?php
declare(strict_types=1);

use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class CreateCompaniesTable extends AbstractMigration
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
    public function change(): void
    {
        $table = $this->table('fund_companies');
        $table
            ->addColumn('name', Column::STRING, [
                'limit' => 30,
                'comment' => '基金公司名称',
            ])
            ->addColumn('short_name', Column::STRING, [
                'limit' => 10,
                'comment' => '基金公司简称',
            ])
            ->addTimestamps()
            ->addIndex('name', [
                'name' => 'idx_name',
            ])
            ->create();
    }
}
