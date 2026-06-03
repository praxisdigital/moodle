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

/**
 * Contains class used to return completion progress information.
 *
 * @package    core_completion
 * @copyright  2017 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core_completion;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/completionlib.php');

/**
 * Class used to return completion progress information.
 *
 * @package    core_completion
 * @copyright  2017 Mark Nelson <markn@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class progress {

    /**
     * Returns the course percentage completed by a certain user, returns null if no completion data is available.
     *
     * @param \stdClass $course Moodle course object
     * @param int $userid The id of the user, 0 for the current user
     * @return null|float The percentage, or null if completion is not supported in the course,
     *         or there are no activities that support completion.
     */
    public static function get_course_progress_percentage($course, $userid = 0) {
        global $USER;

        // Make sure we continue with a valid userid.
        if (empty($userid)) {
            $userid = $USER->id;
        }

        $completion = new \completion_info($course);

        // First, let's make sure completion is enabled. (Cheap; checked every
        // call so capability/setting changes are respected without needing to
        // invalidate the per-request cache below.)
        if (!$completion->is_enabled()) {
            return null;
        }

        // Tracked-user status depends on capabilities which can change during
        // a request (e.g. by accesslib operations in unit tests or admin
        // workflows). Check every call so the result is never stale.
        if (!$completion->is_tracked_user($userid)) {
            return null;
        }

        // Local MDL-60912 perf follow-up: per-request memoisation of the
        // expensive remainder (course completion + per-CM availability +
        // capability resolution). Calendar / Dashboard / Timeline / Starred
        // courses paths call this method many times per request for the same
        // (course, user) pair via course_summary_exporter. The 'NULL' sentinel
        // disambiguates a cached null result from a cache miss (MUC get()
        // returns false on miss).
        //
        // Cache key embeds $course->cacherev so any structural / visibility /
        // availability / grouping change (all bump cacherev via
        // rebuild_course_cache) invalidates the entry naturally. Completion
        // state changes are invalidated explicitly from
        // completion_info::internal_set_data().
        $cacherev = !empty($course->cacherev) ? $course->cacherev : 0;
        $cache = \cache::make_from_params(\cache_store::MODE_REQUEST, 'core', 'mdl60912_progress');
        $cachekey = $course->id . '_' . $userid . '_' . $cacherev;
        $cached = $cache->get($cachekey);
        if ($cached !== false) {
            return $cached === 'NULL' ? null : $cached;
        }

        // Before we check how many modules have been completed see if the course has.
        if ($completion->is_course_complete($userid)) {
            $cache->set($cachekey, 100);
            return 100;
        }

        // Get the number of modules that support completion.
        $modules = $completion->get_user_activities_with_completion($userid);
        $count = count($modules);
        if (!$count) {
            $cache->set($cachekey, 'NULL');
            return null;
        }

        // Get the number of modules that have been completed.
        $totalcompleted = $completion->count_modules_completed($userid, array_keys($modules));

        $result = ($totalcompleted / $count) * 100;
        $cache->set($cachekey, $result);
        return $result;
    }
}
