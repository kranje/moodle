<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Strings for component 'ai', language 'en_us', version '5.1'.
 *
 * @package     ai
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action_explain_text_instruction'] = 'You will receive a text input from the user. Your task is to explain the provided text. Follow these guidelines:
    1. Elaborate: Expand on key ideas and concepts, ensuring the explanation adds meaningful depth and avoids restating the text verbatim.
    2. Simplify: Break down complex terms or ideas into simpler components, making them easy to understand for a wide audience, including learners.
    3. Provide Context: Explain why something happens, how it works, or what its purpose is. Include relevant examples or analogies to enhance understanding where appropriate.
    4. Organize Logically: Structure your explanation to flow naturally, beginning with fundamental ideas before moving to finer details.

Important Instructions:
    1. Return the summary in plain text only.
    2. Do not include any markdown formatting, greetings, or platitudes.
    3. Focus on clarity, conciseness, and accessibility.

Ensure the explanation is easy to read and effectively conveys the main points of the original text.';
$string['action_summarise_text'] = 'Summarize text';
$string['action_summarise_text_desc'] = 'Summarizes the text content on a course page.';
$string['availableproviders_desc'] = 'AI providers add AI functionality to your site through \'actions\' like text summarization or image generation.<br/>
You can manage the actions for each provider in their settings.';
$string['error:401'] = 'Unauthorized';
$string['privacy:metadata:ai_action_generate_image:revisedprompt'] = 'The revised prompt of the generated images.';
$string['privacy:metadata:ai_action_summarise_text'] = 'A table storing the summarize text requests made by users.';
$string['privacy:metadata:ai_action_summarise_text:completiontoken'] = 'The completion tokens used to summarize the text.';
$string['privacy:metadata:ai_action_summarise_text:prompt'] = 'The prompt for the summarize text request.';
$string['privacy:metadata:ai_action_summarise_text:prompttokens'] = 'The prompt tokens used to summarize the text.';
