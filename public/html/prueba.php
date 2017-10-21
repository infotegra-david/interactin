<!-- Include Fuel UX files -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="http://localhost:8080/interactin/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<link rel="stylesheet" href="//www.fuelcdn.com/fuelux/3.4.0/css/fuelux.min.css">

<script src="//www.fuelcdn.com/fuelux/3.4.0/js/fuelux.min.js"></script>

<div class="fuelux">
    <div class="wizard" id="orderWizard">
        <ul class="steps">
            <li data-step="1" class="active"><span class="badge">1</span> Add to cart<span class="chevron"></span></li>
            <li data-step="2"><span class="badge">2</span> Shipping address<span class="chevron"></span></li>
        </ul>

        <div class="actions">
            <button type="button" class="btn btn-default btn-prev"><span class="glyphicon glyphicon-arrow-left"></span>Prev</button>
            <button type="button" class="btn btn-default btn-next" data-last="Order">Next<span class="glyphicon glyphicon-arrow-right"></span></button>
        </div>

        <form id="orderForm" method="post" class="form-horizontal">
            <div class="step-content">
                <!-- The first panel -->
                <div class="step-pane active" data-step="1">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Quantity</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" name="quantity" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Size</label>
                        <div class="col-xs-6">
                            <div class="checkbox">
                                <label><input type="checkbox" name="size[]" value="s" /> S</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="size[]" value="m" /> M</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="size[]" value="l" /> L</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="size[]" value="xl" /> XL</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Color</label>
                        <div class="col-xs-6">
                            <div class="checkbox">
                                <label><input type="checkbox" name="color[]" value="white" /> White</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="color[]" value="black" /> Black</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="color[]" value="red" /> Red</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="color[]" value="yellow" /> Yellow</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="color[]" value="green" /> Green</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- The second panel -->
                <div class="step-pane" data-step="2">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Full name</label>

                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="firstName" placeholder="First name" />
                        </div>

                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="lastName" placeholder="Last name" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Phone number</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" name="cellPhone" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Street</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" name="street" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">City</label>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" name="city" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Zipcode</label>
                        <div class="col-xs-3">
                            <input type="text" class="form-control" name="zipCode" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="thankModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thank you</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Thank you for your order</p>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#orderForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        // This option will not ignore invisible fields which belong to inactive panels
        excluded: ':disabled',
        fields: {
            quantity: {
                validators: {
                    notEmpty: {
                        message: 'The quantity is required'
                    },
                    greaterThan: {
                        value: 1,
                        message: 'The quantity must be greater than 0'
                    },
                    integer: {
                        message: 'The quantity must be a number'
                    }
                }
            },
            'size[]': {
                validators: {
                    notEmpty: {
                        message: 'The size is required'
                    }
                }
            },
            'color[]': {
                validators: {
                    notEmpty: {
                        message: 'The color is required'
                    }
                }
            },
            firstName: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The first name is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'The first name can only consist of alphabetical and space'
                    }
                }
            },
            lastName: {
                row: '.col-xs-4',
                validators: {
                    notEmpty: {
                        message: 'The last name is required'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'The last name can only consist of alphabetical and space'
                    }
                }
            },
            cellPhone: {
                validators: {
                    notEmpty: {
                        message: 'The phone number is required'
                    },
                    phone: {
                        country: 'US',
                        message: 'The value is not valid US phone number'
                    }
                }
            },
            street: {
                validators: {
                    notEmpty: {
                        message: 'The street is required'
                    }
                }
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'The city is required'
                    }
                }
            },
            zipCode: {
                validators: {
                    notEmpty: {
                        message: 'The zip code is required'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'The value is not valid US zip code'
                    }
                }
            }
        }
    });

    $('#orderWizard')
        // Call the wizard plugin
        .wizard()

        // Triggered when clicking the Next/Prev buttons
        .on('actionclicked.fu.wizard', function(e, data) {
            var fv         = $('#orderForm').data('formValidation'), // FormValidation instance
                step       = data.step,                              // Current step
                // The current step container
                $container = $('#orderForm').find('.step-pane[data-step="' + step +'"]');

            // Validate the container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === false || isValidStep === null) {
                // Do not jump to the target panel
                e.preventDefault();
            }
        })

        // Triggered when clicking the Complete button
        .on('finished.fu.wizard', function(e) {
            var fv         = $('#orderForm').data('formValidation'),
                step       = $('#orderWizard').wizard('selectedItem').step,
                $container = $('#orderForm').find('.step-pane[data-step="' + step +'"]');

            // Validate the last step container
            fv.validateContainer($container);

            var isValidStep = fv.isValidContainer($container);
            if (isValidStep === true) {
                // Uncomment the following line to submit the form using the defaultSubmit() method
                // fv.defaultSubmit();

                // For testing purpose
                $('#thankModal').modal();
            }
        });
});
</script>