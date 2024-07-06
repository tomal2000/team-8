jQuery.validator.addMethod(
    "exactLength",
    function (value, element, param) {
        return this.optional(element) || value.length == param;
    },
    $.validator.format("Please enter exactly {0} characters.")
);

jQuery.validator.addMethod(
    "bankAccount",
    function (value, element) {
        return (
            this.optional(element) || value.length == 13 || value.length == 17
        );
    },
    "Bank Account Must Have 13 or 17 Digit."
);

jQuery.validator.addMethod(
    "nid",
    function (value, element) {
        return (
            this.optional(element) || value.length == 10 || value.length == 17
        );
    },
    "NID Must Have 10 or 17 Digit."
);

jQuery.validator.addMethod(
    "exactLengthMobile",
    function (value, element) {
        return this.optional(element) || value.length == 11;
    },
    $.validator.format("Mobile Number Must Be 11 Digits")
);
jQuery.validator.addMethod(
    "exactStartingMobile",
    function (value, element) {
        return (
            this.optional(element) ||
            value.slice(0, 3) == "018" ||
            value.slice(0, 3) == "013" ||
            value.slice(0, 3) == "017" ||
            value.slice(0, 3) == "019" ||
            value.slice(0, 3) == "014" ||
            value.slice(0, 3) == "016" ||
            value.slice(0, 3) == "015"
        );
    },
    $.validator.format(
        "Mobile Number Must Be Start With 018,013,017,019,014,016,015"
    )
);
