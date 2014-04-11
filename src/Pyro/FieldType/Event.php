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
        $options = $this->getOptions();

        ksort($options);

        return form_dropdown($this->formSlug, $options, $this->value);
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
            $placeholder = array('-----' => lang_label($placeholder));
        } else {
            $placeholder = array('-----' => lang('global:select-any'));
        }

        return form_dropdown($this->getFilterSlug('is'), $placeholder + $options, $this->getFilterValue('is'));
    }

    /**
     * Get options
     *
     * @return array
     */
    protected function getOptions()
    {
        $options = array();

        foreach (\Events::registered() as $listener) {
            $options[$listener] = $listener;
        }

        return $options;
    }
}
