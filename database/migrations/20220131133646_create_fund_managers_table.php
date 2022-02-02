<?php
declare(strict_types=1);

use Phinx\Db\Table\Column;
use Phinx\Migration\AbstractMigration;

final class CreateFundManagersTable extends AbstractMigration
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
        $table = $this->table('fund_managers');
        $table
            ->addColumn('name', Column::STRING, [
                'limit' => 10,
                'comment' => '基金经理名称',
            ])
            ->addColumn('fund_company_id', Column::INTEGER, [
                'limit' => 10,
                'signed' => false,
                'comment' => '基金公司ID',
            ])
            ->addTimestamps()
            ->addIndex('name', [
                'name' => 'idx_name',
            ])
            ->create();
    }
}
