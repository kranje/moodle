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
 * Strings for component 'qtype_ddmarker', language 'en_us', version '5.1'.
 *
 * @package     qtype_ddmarker
 * @category    string
 * @copyright   1999 Martin Dougiamas and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['dropzones_help'] = 'Drop zones may be defined by coordinates, or dragged into position in the preview above.

First selecting a shape (circle, rectangle or polygon) will add a new drop zone shape to the top left of the preview. It may be useful to minimize the Markers section so you can see the preview while editing the Drop zones.

Editing a shape starts with a click on the shape in the preview to show the editing handles. You can move the shape using the center handle, or adjust the shape\'s dimensions with the vertex handles.

For polygons only, holding the control button (command button on a Mac) while clicking on a vertex handle will add a new vertex to the polygon. Please keep a polygon shape as simple as possible, without crossing lines.

For information the three shapes use coordinates in this way:

* Circle: centre_x, centre_y; radius<br />for example: <code>80,100;50</code>
* Rectangle: top_left_x, top_left_y; width, height<br />for example: <code>20,60;80,40</code>
* Polygon: x1, y1; x2, y2; ...; xn, yn<br />for example: <code>20,60;100,60;20,100</code>

Selecting a Marker text will add that text to the shape in the preview.';
$string['formerror_unrecognisedwidthheightpart'] = 'The width and height that you have specified are unrecognizable. Your coordinates for a {$a->shape} should be expressed as - {$a->coordsstring}.';
$string['formerror_unrecognisedxypart'] = 'The x,y coordinates that you have specified are unrecognizable. Your coordinates for a {$a->shape} should be expressed as - {$a->coordsstring}.';
$string['privacy:preference:penalty'] = 'The penalty for each incorrect try when questions are run using the \'Interactive with multiple tries\' or \'Adaptive mode\' behavior.';
$string['shape_circle_coords'] = 'x,y;r (where x,y are the coordinates of the center of the circle and r is the radius)';
