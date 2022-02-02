<?php
declare(strict_types=1);

use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class CreateFundsTable extends AbstractMigration
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
        $table = $this->table('funds');
        $table
            ->addColumn('code', Column::CHAR, [
                'limit' => 6,
                'comment' => '基金代码',
            ])
            ->addColumn('name', Column::STRING, [
                'limit' => 30,
                'comment' => '基金名称',
            ])
            ->addColumn('short_name', Column::STRING, [
                'limit' => 30,
                'comment' => '基金简称',
            ])
            ->addColumn('fund_company_id', Column::INTEGER, [
                'limit' => 10,
                'signed' => false,
                'comment' => '基金公司ID',
            ])
            ->addTimestamps()
            ->addIndex('code', [
                'unique' => true,
                'name' => 'unq_code',
            ])
            ->addIndex('name', [
                'name' => 'idx_name',
            ])
            ->addIndex('short_name', [
                'name' => 'idx_short_name',
            ])
            ->create();
    }
}
