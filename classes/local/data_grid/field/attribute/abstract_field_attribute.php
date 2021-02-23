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
 * An attribute changes how a field is designated or behaves.
 *
 * @package    block_dash
 * @copyright  2019 bdecent gmbh <https://bdecent.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_dash\local\data_grid\field\attribute;

use block_dash\local\dash_framework\structure\field_interface;

defined('MOODLE_INTERNAL') || die();

/**
 * An attribute changes how field output is formatted.
 *
 * @package block_dash
 */
abstract class abstract_field_attribute implements field_attribute_interface {

    /**
     * @var array
     */
    private $options = [];

    private $field;

    /**
     * New attribute.
     *
     * @param array $options
     */
    public function __construct(array $options = []) {
        $this->set_options($options);
    }

    /**
     * Set the field this attribute is attached to.
     *
     * @param field_interface $field
     */
    public function set_field(field_interface $field) {
        $this->field = $field;
    }

    /**
     * Get the field this attribute is attached to.
     *
     * @return field_interface
     */
    public function get_field() {
        return $this->field;
    }

    /**
     * After records are relieved from database each field has a chance to transform the data.
     * Example: Convert unix timestamp into a human readable date format
     *
     * @param mixed $data Raw data associated with this field.
     * @param \stdClass $record Full record from database.
     * @return mixed
     */
    public function transform_data($data, \stdClass $record) {
        return $data;
    }

    #region Options

    /**
     * Get a single option.
     *
     * @param string $name
     * @return mixed|null
     */
    public function get_option($name) {
        return isset($this->options[$name]) ? $this->options[$name] : null;
    }

    /**
     * Set option on field.
     *
     * @param string $name
     * @param string $value
     */
    public function set_option($name, $value) {
        $this->options[$name] = $value;
    }

    /**
     * Set options on field.
     *
     * @param array $options
     */
    public function set_options($options) {
        foreach ($options as $name => $value) {
            $this->set_option($name, $value);
        }
    }

    /**
     * Get all options for this field.
     *
     * @return array
     */
    public function get_options() {
        return $this->options;
    }

    /**
     * Add option.
     *
     * @param string $name
     * @param string $value
     */
    public function add_option($name, $value) {
        $this->options[$name] = $value;
    }

    #endregion
}