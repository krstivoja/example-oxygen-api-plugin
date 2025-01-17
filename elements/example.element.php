<?php

class ExampleElement extends OxyEl {

    function init() {
        // Do some initial things here.
    }

    function afterInit() {
        // Do things after init, like remove apply params button and remove the add button.
        $this->removeApplyParamsButton();
        // $this->removeAddButton();
    }

    function name() {
        return 'My Example Element';
    }
    
    function slug() {
        return "my-example-element";
    }

    function icon() {
        // Path to icon here.
    }

    function button_place() {
        // return "interactive";
    }

    function button_priority() {
        // return 9;
    }

    
    function render($options, $defaults, $content) {
        // Output here.
        ?>
        <div class='bg-blue-800 p-12 text-2xl text-yellow-100'>Hello</div>
        <?php

        // $this->El->inlineJS(
        //     "document.querySelectorAll('.my-example-class').forEach( (element) => {
        //         element.addEventListener('click', () => {
        //             alert('clicked');
        //         });
        //     })"
        // );
    }

    function controls() {

        // We can create control sections:
        $controlSection = $this->addControlSection("section_slug", __("Section Name"), "assets/icon.png", $this);

        // Later, we can reference $controlSection (or whatever you named your section) and add controls to it
        // If you want to add controls to the primary tab directly, you can use $this instead of $controlSection
        
        // Style controls are mapped directly to a selector and a property, so they're used for simple CSS controls
        $controlSection->addStyleControl(
            array( 
                "name" => __('Control Name'),
                "selector" => ".some-selector > child",
                "property" => 'background-color',
                "control_type" => "colorpicker",
                // "unit" => "px" // We don't need to declare a unit since this field is a color picker, but it's useful to do so for measurebox fields
            )
        );

        // Option controls can be accessed in the render() function via $options['field_slug']
        $controlSection->addOptionControl(
			array(
                "type" => 'textfield', // types: textfield, dropdown, checkbox, buttons-list, measurebox, slider-measurebox, colorpicker, icon_finder, mediaurl
				"name" => 'Field Name',
				"slug" => 'field_slug'
            )
        );

        // If we want to output some CSS based on the value of an Option control, we can do this instead:
        $my_control = $controlSection->addOptionControl(
            array(
                "type" => 'buttons-list', // types: textfield, dropdown, checkbox, buttons-list, measurebox, slider-measurebox, colorpicker, icon_finder, mediaurl
				"name" => 'Field Name Two',
				"slug" => 'field_slug_two'
            )
        );

        // For controls with multiple values, like dropdowns or button lists, you can define them like this:
        $my_control->setValue(
            array(
                'value' => 'Label',
                'value2' => 'Label2'
            )
        );

        // You can define the default:
        $my_control->setDefaultValue('value');

        // You can then conditionally output some CSS depending on the chosen value:
        $my_control->setValueCSS(
            array(
                'value' => '.my-example-class { background-color: purple }',
                'value2' => '.my-example-class { background-color: red }'
            )
        );

        // It's also usually a good idea to whitelist these types of controls for breakpoints:
        $my_control->whitelist();

        // We can also make our element rebuild when a control's value is changed:
        $my_control->rebuildElementOnChange();
        
        // Instead of building out every control ourselves, there are also presets available for commonly needed controls:
        $this->borderSection(
            __("Border Section Name"),
            '.selector',
            $this
        );

        $this->typographySection(
            __("Typography Section Name"),
            '.selector',
            $this
        );

        $this->boxShadowSection(
            __("Shadow Section Name"),
            '.selector',
            $this
        );

        // The flex preset can only be used in a section, and doesn't have accept a name argument
        $controlSection->flex(
            '.selector',
            $this
        );

    }

    function defaultCSS() {

        return file_get_contents(__DIR__.'/'.basename(__FILE__, '.php').'.css');
 
    }
    
}

new ExampleElement();
