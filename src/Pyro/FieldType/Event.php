<?php namespace Pyro\FieldType;

use Pyro\Module\Streams\FieldType\FieldTypeAbstract;

class Event extends FieldTypeAbstract
{
    /**
     * Field type slug
     *
     * @var string
     */
    public $field_type_slug = 'event';

    /**
     * DB col type
     *
     * @var bool
     */
    public $db_col_type = 'string';

    /**
     * Version
     *
     * @var string
     */
    public $version = '1.1.0';

    /**
     * Custom parameters
     *
     * @var array
     */
    public $custom_parameters = array();

    /**
     * Author
     *
     * @var array
     */
    public $author = array(
        'name' => 'Ryan Thompson - AI Web Systems, Inc.',
        'url'  => 'http://www.aiwebsystems.com/'
    );

    /**
     * Form input
     *
     * @return array
     */
    public function formInput()
    {
        return form_dropdown($this->formSlug, $this->getOptions(), $this->value);
    }

    /**
     * Filter input
     *
     * @return array
     */
    public function filterInput()
    {
        $options = $this->getOptions();

        if ($placeholder = $this->getParameter('filter_placeholder')) {
            $options = array('-----' => $placeholder) + $options;
        }

        return form_dropdown($this->getFilterSlug('is'), $options, $this->getFilterValue('is'));
    }

    /**
     * Get options
     *
     * @return array
     */
    protected function getOptions()
    {
        $options = array();

        foreach (Events::registered() as $listener) {
            $options[$listener] = $listener;
        }

        return $options;
    }
}
