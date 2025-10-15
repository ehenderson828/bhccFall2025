// Once the form has loaded:
$(document).ready(() => {
    // Shift the focus onto the arrival date input
    $("#arrival_date").focus();

    // Set arrival date input type to date for calendar picker
    $("#arrival_date").attr("type", "date");

    // Set nights input type to number for counter
    $("#nights").attr("type", "number");

    // Set email input type to email
    $("#email").attr("type", "email");

    // Set phone input type to tel
    $("#phone").attr("type", "tel");

    // Calculate date range for arrival date validation
    let today = new Date();
    let threeMonths = new Date();
    threeMonths.setMonth(threeMonths.getMonth() + 3);

    // Add validation method for date range (today to 3 months out)
    $.validator.addMethod("dateRange", (value, element) => {
        if (!value) return true; // Let required rule handle empty values
        let selectedDate = new Date(value);
        return selectedDate >= today && selectedDate <= threeMonths; // Return selected date if it's valid
    }, "Arrival date must be between today and 3 months from now");

    // Add validation method for checking if children outnumber adults
    $.validator.addMethod("childrenLessThanAdults", (value, element) => {
        let children = parseInt($("#children").val());
        let adults = parseInt($("#adults").val());
        return children <= adults;
    }, "Number of children cannot exceed number of adults");

    // jQuery Validation
    $("#reservation_form").validate({
        rules: {
            arrival_date: {
                required: true,
                date: true,
                dateRange: true  // Custom date range validation
            },
            nights: {
                required: true,
                digits: true,
                min: 1,
                max: 10
            },
            adults: {
                required: true,
                childrenLessThanAdults: true  // Custom rule
            },
            children: {
                required: true
            },
            name: {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                phoneUS: true  // From additional-methods plugin
            }
        },
        messages: {
            arrival_date: {
                required: "Please enter an arrival date",
                date: "Please enter a valid date",
                dateRange: "Date must be less than three months away"
            },
            nights: {
                required: "Please enter the number of nights",
                digits: "Please enter a positive number",
                min: "Minimum stay is 1 night",
                max: "Maximum stay is 10 nights"
            },
            adults: {
                required: "Please select number of adults"
            },
            children: {
                required: "Please select number of children"
            },
            name: {
                required: "Please enter your name",
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
        }
    });

    // Reset button logic
    $("#reset").on("click", () => {
        // Clear all error warnings
        $("#reservation_form").validate().resetForm();
        // Clear all text inputs
        $("#arrival_date, #nights, #name, #email, #phone").val("");
        // Reset select dropdowns to first option
        $("#adults").val("1");
        $("#children").val("0");
        // Reset radio buttons to default checked state
        $("#standard").prop("checked", true);
        $("#king").prop("checked", true);
        // Uncheck smoking checkbox
        $("#smoking").prop("checked", false);
        // Focus on the first input again
        $("#arrival_date").focus();
    });
}); // end ready
