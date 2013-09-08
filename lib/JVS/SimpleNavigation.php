<?php
namespace JVS;

/**
 * Format navigation items into proper HTML
 *
 * @author Javier Villanueva <info@jvsoftware.com>
 */
class SimpleNavigation
{
    /**
     * Output navigation
     *
     * @param  array  $menuItems Menu items array
     * @return string            HTML output
     */
    public function make(array $menuItems)
    {
        $html = '<ul>';

        foreach ($menuItems as $label => $url) {
            $html .= '<li>';

            // Link to url if present otherwise link to "#"
            $html .= '<a href="' . ( (!is_int($label) and !is_array($url)) ? $url : '#' ) . '">';
            $html .= !is_int($label) ? $label : $url;
            $html .= '</a>';

            // Run recursively if a nested array is found
            $html .= is_array($url) ? $this->make($url) : '';

            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
