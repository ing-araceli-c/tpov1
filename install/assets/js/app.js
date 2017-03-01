/**
 * Created by Imani on 2/18/14.
 */
$(document).ready(function() {
    $('.dbConfig').bootstrapValidator({
        message: 'This value is not valid',
        submitHandler: function(validator, form) {
            // validator is the BootstrapValidator instance
            // form is the jQuery object present the current form
            form.find('.alert').html('Thanks for signing up. Now you can sign in as ' + validator.getFieldElement('username').val()).show();
            //form.submit();
        },
        fields: {
            dbHost: {
                validators: {
                    notEmpty: {
                        message: 'The Database Host is required and can\'t be empty'
                    }
                }
            },
            dbUser: {
                message: 'The Database Username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Database Username is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'The Database Username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            dbPass: {
                validators: {
                    notEmpty: {
                        message: 'The Database Password is required and can\'t be empty'
                    }
                }
            },
            dbName: {
                validators: {
                    required: true,
                    notEmpty: {
                        message: 'The Database Name is required and can\'t be empty'
                    }
                }
            }
        },
        live: 'enabled',
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }

    });
});

$(document).ready(function() {
    $('.coreConfig').bootstrapValidator({
        message: 'This value is not valid',
        submitHandler: function(validator, form) {
            // validator is the BootstrapValidator instance
            // form is the jQuery object present the current form
            form.find('.alert').html('Thanks for signing up. Now you can sign in as ' + validator.getFieldElement('username').val()).show();
            //form.submit();
        },
        fields: {
            dbHost: {
                validators: {
                    notEmpty: {
                        message: 'The Database Host is required and can\'t be empty'
                    }
                }
            },
            dbUser: {
                message: 'The Database Username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Database Username is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 30,
                        message: 'The Database Username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            dbPass: {
                validators: {
                    notEmpty: {
                        message: 'The Database Password is required and can\'t be empty'
                    }
                }
            },
            dbName: {
                validators: {
                    required: true,
                    notEmpty: {
                        message: 'The Database Name is required and can\'t be empty'
                    }
                }
            }
        },
        live: 'enabled',
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }

    });
});


$('.siteKeywords').tagsInput({
    'width':'100%',
    'defaultText':'Add a Keyword'
});


$(function(){

    $('#tags').tagsInput({
        "width": "75%",
        "height": "70px",
        'defaultText':''
    });


    $('#tags3').tagsInput({
        'width': '90%',
        'height':'70px',
        'defaultText':'Add Tag',
        'autocomplete_url':'/2013/js/jQuery-Tags-Input/test/fake_json_endpoint.html' // jquery ui autocomplete requires a json endpoint
    });


    $('#tags4').tagsInput({
        'width': '90%',
        'height':'70px',
        'defaultText':'Add Tag'
    });

    $('#tags_tag').focus();
});



/*

$(window).scroll(function () {
    if ( $(this).scrollTop() > 200 && !$('header').hasClass('open') ) {
        $('header').addClass('open');
        $('header').slideDown();
    } else if ( $(this).scrollTop() <= 200 ) {
        $('header').removeClass('open');
        $('header').slideUp();
    }
});

*/




// tooltip demo
$('.theInstall').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})

$('.tooltip-test').tooltip()
$('.popover-test').popover()

$('.bs-docs-navbar').tooltip({
    selector: "a[data-toggle=tooltip]",
    container: ".bs-docs-navbar .nav"
})

// popover demo
$("[data-toggle=popover]")
    .popover()




(function(jQuery){

    jQuery( document ).ready( function() {

        prettyPrint();

    } );

}(jQuery))


$(".collapse").collapse();
$('body').scrollspy({ target: '#theNav' })











