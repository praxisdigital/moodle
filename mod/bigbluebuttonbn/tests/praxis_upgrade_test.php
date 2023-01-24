<?php

namespace mod_bigbluebuttonbn;

// @codeCoverageIgnoreStart
defined('MOODLE_INTERNAL') || die();
// @codeCoverageIgnoreEnd

class praxis_upgrade_test extends \advanced_testcase {

	protected function setUp(): void{
		$this->resetAfterTest();
	}

	public function test_fields_are_created_if_not_exists(): void{

	    // Remove fields from existing installation
		global $DB;
		$dbman = $DB->get_manager();

		$table = new \xmldb_table('bigbluebuttonbn');

		$remotedatatstamp_field = new \xmldb_field('remotedatatstamp');
		if($dbman->field_exists($table, $remotedatatstamp_field)){
			$dbman->drop_field($table, $remotedatatstamp_field);
		}

		$completionengagementchats_field = new \xmldb_field('completionengagementchats');
		if($dbman->field_exists($table, $completionengagementchats_field)){
			$dbman->drop_field($table, $completionengagementchats_field);
		}

		$completionengagementtalks_field = new \xmldb_field('completionengagementtalks');
		if($dbman->field_exists($table, $completionengagementtalks_field)){
			$dbman->drop_field($table, $completionengagementtalks_field);
		}

		$completionengagementraisehand_field = new \xmldb_field('completionengagementraisehand');
		if($dbman->field_exists($table, $completionengagementraisehand_field)){
			$dbman->drop_field($table, $completionengagementraisehand_field);
		}

		$completionengagementpollvotes_field = new \xmldb_field('completionengagementpollvotes');
		if($dbman->field_exists($table, $completionengagementpollvotes_field)){
			$dbman->drop_field($table, $completionengagementpollvotes_field);
		}

		$completionengagementemojis_field = new \xmldb_field('completionengagementemojis');
		if($dbman->field_exists($table, $completionengagementemojis_field)){
			$dbman->drop_field($table, $completionengagementemojis_field);
		}

		// Check fields are removed
		$this->assert_db_field_not_exists($table, $remotedatatstamp_field);
		$this->assert_db_field_not_exists($table, $completionengagementchats_field);
		$this->assert_db_field_not_exists($table, $completionengagementtalks_field);
		$this->assert_db_field_not_exists($table, $completionengagementraisehand_field);
		$this->assert_db_field_not_exists($table, $completionengagementpollvotes_field);
		$this->assert_db_field_not_exists($table, $completionengagementemojis_field);

		// Lowering version of existing installation = 2022041901 to trigger upgrade
		$sql = /** @lang mysql */ "
			UPDATE {config_plugins} 
			SET value = 2022041901 
			WHERE plugin = 'mod_bigbluebuttonbn' 
			AND name = 'version'
		";
		$DB->execute($sql);

		// Make Moodle re-calculate version hash
		$sql = /** @lang mysql */"
			UPDATE {config} 
			SET value = '' 
			WHERE name = 'allversionshash'
		";
		$DB->execute($sql);

		// Run upgrade script
		require_once __DIR__.'/../db/upgrade.php';
		xmldb_bigbluebuttonbn_upgrade(2022041901);

		// Check fields exists
		$this->assert_db_field_exists($table, $remotedatatstamp_field);
		$this->assert_db_field_exists($table, $completionengagementchats_field);
		$this->assert_db_field_exists($table, $completionengagementtalks_field);
		$this->assert_db_field_exists($table, $completionengagementraisehand_field);
		$this->assert_db_field_exists($table, $completionengagementpollvotes_field);
		$this->assert_db_field_exists($table, $completionengagementemojis_field);
	}

	private function assert_db_field_exists(\xmldb_table $table, \xmldb_field $field, string $message = ''): void{
		$this->assertThat($this->field_exists($table, $field), static::isTrue(), $message);
	}

	private function assert_db_field_not_exists(\xmldb_table $table, \xmldb_field $field, string $message = ''): void{
		$this->assertThat($this->field_exists($table, $field), static::isFalse(), $message);
	}

	private function field_exists(\xmldb_table $table, \xmldb_field $field): bool{
		global $DB;
		return $DB->get_manager()->field_exists($table, $field);
	}
}