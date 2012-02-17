<?php
// This file is part of Stack - http://stack.bham.ac.uk/
//
// Stack is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Stack is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Stack.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Answer test controller class.
 *
 * @copyright  2012 University of Birmingham
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once(dirname(__FILE__) . '/anstest.class.php');
require_once(dirname(__FILE__) . '/at_general_cas.class.php');
require_once(dirname(__FILE__) . '/../cas/connector.class.php');
require_once(dirname(__FILE__) . '/../cas/casstring.class.php');
require_once(dirname(__FILE__) . '/../cas/cassession.class.php');

class stack_ans_test_controller {
    // Attributes
    /**
     *
     *
     * @var    array(string)
     * @access private
     */
    private static $avaliable_ans_tests;

    /**
     * The answertest object that the functions call
     * @var string
     * @access private
     */
    private $at;

    // Operations

    /**
     *
     *
     * @param  string $AnsTest
     * @param  string $sans A CAS string assumed to represent the student's answer.
     * @param  string $tans A CAS string assumed to represent the tecaher's answer.
     * @param  object $options
     * @param  CasString $casoption
     * @access public
     */
    public function __construct($anstest = null, $sans = null, $tans = null, $options = null, $casoption = null) {
        $this->avaliableAnsTests = array('AlgEquiv'=>stack_string("stackOptions_AnsTest_values_AlgEquiv"),
              'EqualComAss'=> stack_string("stackOptions_AnsTest_values_Equal_com_ass"),
              'CasEqual'     => stack_string("stackOptions_AnsTest_values_CASEqual"),
              'SameType'     => stack_string("stackOptions_AnsTest_values_SameType"),
              'SubstEquiv'   => stack_string("stackOptions_AnsTest_values_SubstEquiv"),
              'SysEquiv'     => stack_string("stackOptions_AnsTest_values_SysEquiv"),
              'Expanded'     => stack_string("stackOptions_AnsTest_values_Expanded"),
              'FacForm'      => stack_string("stackOptions_AnsTest_values_FacForm"),
              'SingleFrac'   => stack_string("stackOptions_AnsTest_values_SingleFrac"),
              'PartFrac'     => stack_string("stackOptions_AnsTest_values_PartFrac"),
              'CompSquare'   => stack_string("stackOptions_AnsTest_values_CompSquare"),
              'GT'           => stack_string("stackOptions_AnsTest_values_Num_GT"),
              'GTE'          => stack_string("stackOptions_AnsTest_values_Num_GTE"),
              'NumAbsolute'  => stack_string("stackOptions_AnsTest_values_Num_tol_absolute"),
              'NumRelative'  => stack_string("stackOptions_AnsTest_values_Num_tol_relative"),
              'NumSigFigs'   => stack_string("stackOptions_AnsTest_values_Num_sig_figs"),
              'LowestTerms'  => stack_string("stackOptions_AnsTest_values_Num_LowestTerms"),
              'Diff'         => stack_string("stackOptions_AnsTest_values_Diff"),
              'Int'          => stack_string("stackOptions_AnsTest_values_Int"),
              'String'       => stack_string("stackOptions_AnsTest_values_String"),
              'StringSloppy' => stack_string("stackOptions_AnsTest_values_StringSloppy"),
              'RegExp'       => stack_string("stackOptions_AnsTest_values_RegExp"),
              );
        //echo "<br>In Anstest controller: $AnsTest<br>";
        switch($anstest) {
            case 'AlgEquiv':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATAlgEquiv', false, $casoption, $options);
                break;

            case 'EqualComAss':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATEqual_com_ass', false, $casoption, $options, 0);
                break;

            case 'CasEqual':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATCASEqual', false, $casoption, $options);
                break;

            case 'SameType':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATSameType', false, $casoption, $options);
                break;

            case 'SubstEquiv':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATSubstEquiv', false, $casoption, $options);
                break;

            case 'Expanded':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATExpanded', false, $casoption, $options);
                break;

            case 'FacForm':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATFacForm', true, $casoption, $options);
                break;

            case 'SingleFrac':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATSingleFrac', false, $casoption, $options, 0);
                break;

            case 'PartFrac':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATPartFrac', true, $casoption, $options);
                break;

            case 'CompSquare':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATCompSquare', true, $casoption, $options);
                break;

            case 'String':
                require_once(dirname(__FILE__) . '/atstring.class.php');
                $this->at = new stack_anstest_atstring($sans, $tans, $options, $casoption);
                break;

            case 'StringSloppy':
                require_once(dirname(__FILE__) . '/stringsloppy.class.php');
                $this->at = new stack_anstest_stringsloppy($sans, $tans, $options, $casoption);
                break;

            case 'RegExp':
                require_once(dirname(__FILE__) . '/atregexp.class.php');
                $this->at = new stack_anstest_atregexp($sans, $tans, $options, $casoption);
                break;

            case 'Diff':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATDiff', true, $casoption, $options);
                break;

            case 'Int':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATInt', true, $casoption, $options);
                break;

            case 'GT':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATGT', false, $casoption, $options);
                break;

            case 'GTE':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATGTE', false, $casoption, $options);
                break;

            case 'NumAbsolute':
                require_once(dirname(__FILE__) . '/numabsolute.class.php');
                $this->at = new stack_anstest_numabsolute($sans, $tans, $options, $casoption);
                break;

            case 'NumRelative':
                require_once(dirname(__FILE__) . '/numrelative.class.php');
                $this->at = new stack_anstest_numrelative($sans, $tans, $options, $casoption);
                break;

            case 'NumSigFigs':
                // Set a default option
                if ('' == trim($casoption)) {
                    $casoption = '3';
                }
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATNumSigFigs', true, $casoption, $options);
                break;

            case 'LowestTerms':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATLowestTerms', false, $casoption, $options, 0);
                break;

            case 'SysEquiv':
                $this->at = new stack_answertest_general_cas($sans, $tans, 'ATSysEquiv', false, $casoption, $options);
                break;

            default:
                throw new Exception('stack_ans_test_controller: called with invalid answer test name: '.$anstest);
        }

    }


    /**
     *
     *
     * @return bool
     * @access public
     */
    public function do_test() {
        $result = $this->at->do_test();
        return $result;
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function get_at_errors() {
        return $this->at->get_at_errors();
    }

    /**
     *
     *
     * @return float
     * @access public
     */
    public function get_at_mark() {
        return $this->at->get_at_mark();
    }

    /**
     *
     *
     * @return bool
     * @access public
     */
    public function get_at_valid() {
        return $this->at->get_at_valid();
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function get_at_answernote() {
        return $this->at->get_at_answernote();
    }

    /**
     *
     *
     * @return string
     * @access public
     */
    public function get_at_feedback() {
        $rawfeedback = $this->at->get_at_feedback();

        if (strpos($rawfeedback, 'stack_trans') === false) {
            return $this->at->get_at_feedback();
        } else {
            //echo "<br />Raw string:<pre>$rawfeedback</pre>";
            $rawfeedback = str_replace('[[', '', $rawfeedback);
            $rawfeedback = str_replace(']]', '', $rawfeedback);
            $rawfeedback = str_replace('\n', '', $rawfeedback);
            $rawfeedback = str_replace('\\', '\\\\', $rawfeedback);
            $rawfeedback = str_replace('$', '\$', $rawfeedback);
            $rawfeedback = str_replace('!quot!', '"', $rawfeedback);

            ob_start();
            eval($rawfeedback);
            $translated = ob_get_contents();
            ob_end_clean();

            return $translated;
        }
    }

    /**
     *
     *
     * @return array(string)
     * @access public
     */
    public function stack_available_answer_tests() {
        return $this->avaliableAnsTests;
    }

    /**
     * Returns a list of available answertests
     * @access public
     * @return string xhtml
     *
     */
    public function get_edit_dropdown($current, $name='') {

        $widget = "<select name=\"$name\">";
        foreach ($this->avaliableAnsTests as $label => $localName) {
        //answertests have been localised, this displays the correct name
            if ($label == $current) {
                $widget .= "<option value=\"$label\" selected>$localName</option>";
            } else {
                $widget .= "<option value=\"$label\">$localName</option>";
            }
        }
        $widget .= '</select>';
        return $widget;
    }

    /**
     * Returns whether the testops should be processed by the CAS for this AnswerTest
     * Returns true if the Testops should be processed.
     *
     * @return bool
     * @access public
     */
    public function process_atoptions() {
        return $this->at->process_atoptions();
    }

}
