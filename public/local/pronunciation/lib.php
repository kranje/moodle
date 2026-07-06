<?php
defined('MOODLE_INTERNAL') || die();

/**
 * Add pronunciation audio buttons to the course participants page.
 */
function local_pronunciation_before_footer() {
    global $PAGE, $DB;

    if ($PAGE->pagetype !== 'course-view-participants'
            && strpos($PAGE->url->out(false), '/user/index.php') === false) {
        return;
    }

    $courseid = optional_param('id', 0, PARAM_INT);
    if (empty($courseid)) {
        return;
    }

    $context = context_course::instance($courseid, IGNORE_MISSING);
    if (!$context || !has_capability('moodle/course:viewparticipants', $context)) {
        return;
    }

    $field = $DB->get_record('user_info_field',
        ['shortname' => 'pronunciation_url'],
        'id',
        IGNORE_MISSING
    );

    if (!$field) {
        return;
    }

    $records = $DB->get_records_sql_menu("
        SELECT d.userid, d.data
          FROM {user_info_data} d
         WHERE d.fieldid = :fieldid
           AND " . $DB->sql_compare_text('d.data') . " <> ''
    ", ['fieldid' => $field->id]);

    if (empty($records)) {
        return;
    }

    $json = json_encode($records, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

    $PAGE->requires->js_init_code("
    window.pronunciationUrls = {$json};

    function addPronunciationButtons() {
        const links = document.querySelectorAll('a[href*=\"/user/view.php\"]');

        links.forEach(function(link) {
            let userid = null;

            try {
                const url = new URL(link.href, window.location.origin);
                userid = url.searchParams.get('id');
            } catch (e) {
                return;
            }

            if (!userid || !window.pronunciationUrls[userid]) {
                return;
            }

            if (link.dataset.pronunciationAdded === '1') {
                return;
            }

            link.dataset.pronunciationAdded = '1';

            const icon = document.createElement('button');
            icon.type = 'button';
            icon.textContent = ' 🔊';
            icon.title = 'Play pronunciation';
            icon.className = 'btn btn-link btn-sm p-0 ms-1';
            icon.setAttribute('aria-label', 'Play pronunciation');

            icon.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const audio = new Audio(window.pronunciationUrls[userid]);
                audio.play().catch(function() {});
            });

            link.insertAdjacentElement('afterend', icon);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        addPronunciationButtons();

        const observer = new MutationObserver(function() {
            addPronunciationButtons();
        });

        const target = document.querySelector('[data-region=\"participants\"]')
            || document.querySelector('#participants')
            || document.querySelector('table')
            || document.body;

        observer.observe(target, {
            childList: true,
            subtree: true
        });
    });
");
}
