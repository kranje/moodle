<?php
/**
 * NSSE Survey -- For logged in user, displays link to their individualized NSSE survey.
 *                Currently configured to only be available to front page.
 *                Block should only be visible if user has a row in the NSSE_ASSESSMENT table.
 *
 * 
 **/
class block_nsse_survey extends block_list {
    function init() {
        $this->title = get_string('pluginname','block_nsse_survey') ;
    }

    function has_config() {
        return false;
    }
	
	function applicable_formats() {  
	    return array('site' => true);
	}

    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;
		
//print_object($USER);		

		//print "hello, its me";
		
        // shortcut -  only for logged in users!
        if (!isloggedin() || isguestuser()) {
            return false;
        }
		
        if ($this->content !== NULL) {
            return $this->content;
        }
		
			  
		$sql = "select nsse_loginid "
		      ."from NSSE_ASSESSMENT "
              ."where username = '".$USER->username. "' " ;
		
        //print $sql;
		//print $USER->username;

        $surveylink = $DB->get_records_sql($sql, null, 0, 20);

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        //print_object($surveylink);
		
		

        if ($surveylink) {
	
            foreach ($surveylink as $link) {
				// should only be one
				//$this->content->items[]="hello world";
				// example:  <a href="https://www.w3schools.com/html/">Visit our HTML tutorial</a>
				$this->content->items[]='<a href="'.format_string($link->nsse_loginid).'" target="_blank">Click here to access your survey</a>';
			}
        } else {
		         return false;
		}
        		
        return $this->content;
    }
}
