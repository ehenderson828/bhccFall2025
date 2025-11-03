// Once the document has loaded
$(document).ready(() => {
    // Initialize popup after page is created
    $('#successPopup').popup();

    //jQuery validation
    $('#contact_form').validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            last_name: {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            phone: {
                required: true,
                phoneUS: true
            },
            email: {
                required: true,
                email: true
            },
            message: {
                required: false,
                maxlength: 500
            }
        },
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "Name must be at least 2 characters",
                maxlength: "Name cannot exceed 50 characters"
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "Name must be at least 2 characters",
                maxlength: "Name cannot exceed 50 characters"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Please enter your phone number",
                phoneUS: "Please enter a valid US phone number"
            }
        },
        submitHandler: (form) => {
            // Show success popup instead of submitting the form
            $('#successPopup').popup('open');
            return false;
        }
    });
    // Reset form when popup closes
    $('#successPopup').on('popupafterclose', () => {
        // Clear all error warnings
        $('#contact_form').validate().resetForm();
        // Remove error labels
        $('#contact_form label.error').remove();
        // Remove error class from inputs
        $('#contact_form input, #contact_form textarea').removeClass('error');
        // Clear all text inputs
        $('#first_name, #last_name, #phone, #email, #message').val('');
    });

    // Reset form button logic - only prevent default for the button itself
    $('#reset').on('click', (e) => {
        // Only prevent default, don't stop propagation
        e.preventDefault();
        // Clear all error warnings
        $('#contact_form').validate().resetForm();
        // Remove error labels
        $('#contact_form label.error').remove();
        // Remove error class from inputs
        $('#contact_form input, #contact_form textarea').removeClass('error');
        // Clear all text inputs
        $('#first_name, #last_name, #phone, #email, #message').val('');
    });
});