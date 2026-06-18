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
 * Adhoc task to clean automated backups for a course.
 *
 * @package    core
 * @copyright  2026 onwards Martin Dougiamas  http://dougiamas.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_automated_backup_cleanup_task extends adhoc_task {
    /**
     * Run the adhoc task.
     */
    public function execute() {
        global $DB, $CFG;

        require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');
        require_once($CFG->dirroot . '/backup/util/helper/backup_cron_helper.class.php');

        $courseid = (int)($this->get_custom_data()->courseid ?? 0);
        if (!$courseid) {
            mtrace('Invalid course id: ' . $courseid . ', task aborted.');
            return;
        }

        $course = $DB->get_record('course', ['id' => $courseid]);
        if (!$course) {
            mtrace('Invalid course id: ' . $courseid . ', task aborted.');
            return;
        }

        $lockfactory = \core\lock\lock_config::get_lock_factory('course_backup_adhoc');
        if (!$lock = $lockfactory->get_lock('course_backup_adhoc_task_' . $courseid, 10)) {
            mtrace('Automated backup or cleanup for course: ' . $course->fullname . ' is already running.');
            return;
        }

        try {
            mtrace('Processing automated backup cleanup for course: ' . $course->fullname);
            \backup_cron_automated_helper::remove_excess_backups($course, time());
        } finally {
            $lock->release();
            mtrace('Automated backup cleanup for course: ' . $course->fullname . ' completed.');
        }
    }
}
