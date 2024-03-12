<?php
// ITAI hack
require_once(__DIR__ . '/../../config.php');

global $CFG;
require_once($CFG->dirroot . '/mod/quiz/locallib.php');
require_once($CFG->dirroot . '/mod/quiz/report/reportlib.php');

use mod_quiz\quiz_attempt;

$attemptid     = required_param('attempt',  PARAM_INT);
$url = new moodle_url('/mod/quiz/simplifiedresult.php', array('attempt'=>$attemptid));
$PAGE->set_url($url);

$attemptobj = quiz_attempt::create($attemptid);


// Check login.
require_login($attemptobj->get_course(), false, $attemptobj->get_cm());
$attemptobj->check_review_capability();


$attempt = $attemptobj->get_attempt();
$options = $attemptobj->get_display_options(true);
$quiz = $attemptobj->get_quiz();
$quizobj =  $attemptobj->get_quizobj();


$summarydata = array();
// Show marks (if the user is allowed to see marks at the moment).
$grade = quiz_rescale_grade($attempt->sumgrades, $quiz, false);
if ($options->marks >= question_display_options::MARK_AND_MAX && quiz_has_grades($quiz)) {

    if ($attempt->state != quiz_attempt::FINISHED) {
        $summarydata['grade'] = array(
            'title'   => get_string('grade', 'quiz'),
            'content' => get_string('attemptstillinprogress', 'quiz'),
        );

    } else if (is_null($grade)) {
        $summarydata['grade'] = array(
            'title'   => get_string('grade', 'quiz'),
            'content' => quiz_format_grade($quiz, $grade),
        );

    } else {

        // Now the scaled grade.
        $a = new stdClass();
        $a->grade = html_writer::tag('b', quiz_format_grade($quiz, $grade));
        $a->maxgrade = quiz_format_grade($quiz, $quiz->grade);
        $addresultexplanation = '';
        $link= '<a href="#" onclick="javascript:toggle_explanation_visibility();">' . get_string('resultexplanationlink','quiz') . '</a>';

        $a->percent = html_writer::tag('b', format_float(
            $attempt->sumgrades * 100 / $quiz->sumgrades, 0));
        if ($attempt->sumgrades < $quiz->sumgrades){
            //$addresultexplanation = get_string('seeresultexplanation', 'quiz', $link);
        }

        $formattedgrade = get_string('resultvalue', 'quiz', $a);
        $summarydata['grade'] = array(
            'title'   => get_string('result', 'quiz'),
            'content' => $formattedgrade . $addresultexplanation,
        );
    }
}

// Feedback if there is any, and the user is allowed to see it now.
$feedback = $attemptobj->get_overall_feedback($grade);
if ($options->overallfeedback && $feedback) {
    $summarydata['feedback'] = array(
        'title'   => get_string('feedback', 'quiz'),
        'content' => $feedback,
    );
}

$output = $PAGE->get_renderer('mod_quiz');

// Arrange for the navigation to be displayed.
//$navbc = $attemptobj->get_navigation_panel($output, 'quiz_review_nav_panel', $page, $showall);
//$regions = $PAGE->blocks->get_regions();
//$PAGE->blocks->add_fake_block($navbc, reset($regions));


echo $output->review_page_simplified($attemptobj, 0, $summarydata);
echo '<div id="quiz_simplifiedresult_explanation" style="display:none;" class="container-fluid">'.get_string('resultexplanation', 'quiz').'</div>';
$startattempturl = $quizobj->start_attempt_url();
echo $output->start_attempt_button_result_simplified(get_string('tryagain', 'quiz'),$startattempturl, "", false, array() );
echo <<<EOF
<script type="text/javascript">
function toggle_explanation_visibility() {
       var id = "quiz_simplifiedresult_explanation";
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    
	}
</script>
EOF;
