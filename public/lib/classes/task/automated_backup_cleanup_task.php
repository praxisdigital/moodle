<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace core\task;

/**
 * Scheduled task to queue automated backup cleanup tasks.
 *
 * @package    core
 * @copyright  2026 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class automated_backup_cleanup_task extends scheduled_task {
    /** @var int Number of course cleanup tasks to queue each run. */
    private const BATCH_SIZE = 250;

    /**
     * Get a descriptive name for this task (shown to admins).
     *
     * @return string
     */
    public function get_name() {
        return get_string('taskautomatedbackupcleanup', 'admin');
    }

    /**
     * Queue per-course automated backup cleanup tasks.
     */
    public function execute() {
        global $CFG;

        require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');
        require_once($CFG->dirroot . '/backup/util/helper/backup_cron_helper.class.php');

        $config = get_config('backup');
        if ((int)$config->backup_auto_max_kept === 0 && (int)$config->backup_auto_delete_days === 0) {
            mtrace('Automated backup retention is disabled.');
            return;
        }

        $lastcourseid = (int)get_config('backup', 'backup_auto_cleanup_last_courseid');
        $courses = $this->get_courses_after($lastcourseid, self::BATCH_SIZE);

        if (!$courses && $lastcourseid > 0) {
            $lastcourseid = 0;
            $courses = $this->get_courses_after($lastcourseid, self::BATCH_SIZE);
        }

        $queued = 0;
        foreach ($courses as $course) {
            $task = new course_automated_backup_cleanup_task();
            $task->set_custom_data(['courseid' => (int)$course->id]);

            if (manager::queue_adhoc_task($task, true)) {
                $queued++;
            }
            $lastcourseid = (int)$course->id;
        }

        set_config('backup_auto_cleanup_last_courseid', $lastcourseid, 'backup');
        mtrace('Queued ' . $queued . ' automated backup cleanup task(s).');
    }

    /**
     * Get courses after the specified id.
     *
     * @param int $lastcourseid Last processed course id.
     * @param int $limit Number of records to return.
     * @return array Course records.
     */
    private function get_courses_after(int $lastcourseid, int $limit): array {
        global $DB;

        return $DB->get_records_select(
            'course',
            'id > ?',
            [$lastcourseid],
            'id ASC',
            '*',
            0,
            $limit,
        );
    }
}
