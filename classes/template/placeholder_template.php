<?php


namespace block_dash\template;


use block_dash\block_builder;
use block_dash\data_grid\field\field_definition_interface;
use block_dash\data_grid\filter\filter_collection;
use block_dash\data_grid\filter\filter_collection_interface;

class placeholder_template extends abstract_template
{
    /**
     * Get human readable name of template.
     *
     * @return string
     */
    public function get_name()
    {
        return '';
    }

    /**
     * @return string
     */
    public function get_query_template()
    {
        return 'SELECT %%SELECT%% FROM {user} u';
    }

    /**
     * @return field_definition_interface[]
     * @throws \coding_exception
     */
    public function get_available_field_definitions()
    {
        return block_builder::get_field_definitions([
            'u_id',
            'u_firstname'
        ]);
    }

    /**
     * @return filter_collection_interface
     */
    public function get_filter_collection()
    {
        return new filter_collection(get_class($this), $this->get_context());
    }

    /**
     * @return string
     */
    public function get_mustache_template_name()
    {
        return 'block_dash/layout_placeholder';
    }
}
