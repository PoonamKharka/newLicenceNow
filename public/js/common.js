$(document).ready(function () {

    /* Initialize editor */
    $('.summernote').summernote({
        height: 300,   // Set the height of the editor
        placeholder: 'Enter description here...',
        // toolbar: [
        //     ['style', ['bold', 'italic', 'underline', 'clear']],
        //     ['fontsize', ['fontsize']],
        //     ['para', ['ul', 'ol', 'paragraph']],
        //     ['height', ['height']]
        // ],
        callbacks: {
            onBlur: function () {
                var contents = $('.summernote').summernote('code');
                var cleanContent = contents.replace(/&nbsp;/g, ' ');
                $('.summernote').next('textarea').val(cleanContent);

            }
        }
    });


    /* Test Package module */
    $('#testpackageForm').on('submit', function (e) {
        let isValid = true;


        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');


        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }


        const imageInput = $('input[name="image"]');
        if (imageInput.get(0).files.length > 0) {
            const file = imageInput.get(0).files[0];
            const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            const maxSizeInBytes = 2048 * 1024; // 2MB

            // Validate image type
            if (!validImageTypes.includes(file.type)) {
                isValid = false;
                imageInput.addClass('is-invalid').after('<div class="error-message text-danger">Please upload a valid image (jpeg, png, gif).</div>');
            }

            // Validate image size
            if (file.size > maxSizeInBytes) {
                isValid = false;
                imageInput.addClass('is-invalid').after('<div class="error-message text-danger">Image size must be less than 2MB.</div>');
            }
        }

        // Validate Price
        const priceInput = $('input[name="price"]');
        const priceValue = priceInput.val();
        if (priceValue === '' || isNaN(priceValue) || parseFloat(priceValue) < 0) {
            isValid = false;
            priceInput.addClass('is-invalid').after('<div class="error-message text-danger">Price must be a positive numeric value.</div>');
        }

        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description === '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    /* Articles module */
    $('#articlesForm').on('submit', function (e) {
        let isValid = true;


        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');


        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }
        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description === '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    /* FeatureForm module */
    $('#featureForm').on('submit', function (e) {
        let isValid = true;


        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');


        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }


        const imageInput = $('input[name="image"]');
        if (imageInput.get(0).files.length > 0) {
            const file = imageInput.get(0).files[0];
            const validImageTypes = ['image/svg+xml'];
            const validFileExtensions = ['svg'];
            const maxSizeInBytes = 2048 * 1024; // 2MB

            // Get file extension
            const fileExtension = file.name.split('.').pop().toLowerCase();

            // Validate image type (only SVG) by MIME type or extension
            if (!validImageTypes.includes(file.type) || !validFileExtensions.includes(fileExtension)) {
                isValid = false;
                imageInput.addClass('is-invalid').after('<div class="error-message text-danger">Please upload a valid SVG image.</div>');
            }

            // Validate image size
            if (file.size > maxSizeInBytes) {
                isValid = false;
                imageInput.addClass('is-invalid').after('<div class="error-message text-danger">Image size must be less than 2MB.</div>');
            }
        }


        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description === '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    /* Learner module */
    $('#learnerForm').on('submit', function (e) {
        let isValid = true;


        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');


        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }
        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description === '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
    /* Instructor module */
    $('#instructorForm').on('submit', function (e) {
        let isValid = true;


        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');


        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }
        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description === '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    /* Privacy Policy Articles module */
    $('#privacyPolicyForm').on('submit', function (e) {
        let isValid = true;


        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');


        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }
        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description === '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
    /* Payment Policy Articles module */
    $('#paymentPolicyForm').on('submit', function (e) {
        let isValid = true;


        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');


        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }
        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description === '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
    /* Nav menu module */
    $('#navMenuForm').on('submit', function (e) {
        let isValid = true;
        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');
        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }
        if ($('input[name="slug"]').val().trim() === '') {
            isValid = false;
            $('input[name="slug"]').addClass('is-invalid').after('<div class="error-message text-danger">Slug is required.</div>');
        }
        if (!isValid) {
            e.preventDefault();
        }
    });

    /* Instructors Details module */
    $.validator.addMethod("noWhitespace", function (value, element) {
        return $.trim(value).length > 0;
    }, "This field is required");

    $.validator.addMethod("phoneAU", function (value, element) {

        value = value.replace(/\s+/g, "").replace(/[-()]/g, "");
        return this.optional(element) || value.match(/^(\(0[2-8]\)|0[2-8])\d{8}$/) || value.match(/^04\d{8}$/);
    }, "Please enter a valid Australian phone number(e.g., 0412345678).");

    $.validator.addMethod("checkboxRequired", function (value, element, params) {
        return $(params).is(":checked");
    }, "This field is required");

    $.validator.addMethod("fileExtension", function (value, element, param) {
        const extension = value.split('.').pop().toLowerCase();
        return this.optional(element) || $.inArray(extension, param.split('|')) !== -1;
    }, "Only JPG, JPEG, and PNG files are allowed.");

    // Ensure the file is an image and check the size limit
    $.validator.addMethod("fileSize", function (value, element) {
        if (element.files && element.files[0]) {
            const fileSize = element.files[0].size / 1024; // size in KB
            return this.optional(element) || fileSize <= 2048; // 2048 KB = 2 MB
        }
        return true; // If no file, treat as valid
    }, "File size must be less than 2048 KB.");
    $.validator.addMethod("eitherRequired", function (value, element) {
        // Check if either 'isAuto' or 'isManual' is checked
        return $("input[name='isAuto']").is(":checked") || $("input[name='isManual']").is(":checked");
    }, "Please select either Auto or Manual.");




    $('select[name="gender_id"]').select2();
    $('select[name="blood_group_id"]').select2();

    $("#personal_details").validate({

        rules: {
            name: {
                required: true,
                noWhitespace: true
            },
            date_of_birth: {
                required: true,
                //dateISO: true,
                noWhitespace: true
            },
            isAuto: {
                eitherRequired: true
            },
            isManual: {
                eitherRequired: true
            },
            'languages[]': {
                checkboxRequired: 'input[name="languages[]"]'
            },
            date_of_joining: {
                required: true,
                //dateISO: true
            },
            gender_id: {
                required: true
            },
            phoneNo: {
                required: true,
                remote: {
                    url: "/admin/validate-phone",
                    type: "POST",
                    data: {
                        phoneNo: function () {
                            return $("input[name='phoneNo']").val();
                        },
                        _token: $("input[name='_token']").val(),
                    }
                }
            },
            blood_group_id: {
                required: true
            },
            driving_expirence: {
                required: true,
            },
            contact_address: {
                required: true,
            },
            profile_picture: {
                // required: function (element) {
                //     // Check if the user already has a profile picture or not
                //     return $('input[name="existing_profile_picture"]').val() === "";
                // },
                fileExtension: "jpeg|jpg|png",
                fileSize: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 3 characters long"
            },
            date_of_birth: {
                required: "Please enter your date of birth",
                date: "Please enter a valid date"
            },
            phoneNo: {
                required: "Please enter a phone number.",
                remote: "This phone number is already in use."
            },
            profile_picture: {
                required: "Please upload a profile picture.",
                fileExtension: "Only JPG, JPEG, and PNG files are allowed.",
                fileSize: "File size must be less than 2048 KB."
            }
        },
        submitHandler: function (form, event) {
            //event.preventDefault();
            console.log("Form validated successfully");
            form.submit();

        },
        invalidHandler: function (event, validator) {
            // This function is called when the form is invalid
            console.log("Form is invalid.");
        }
    });

    // Re-validate selects when their value changes
    $('select[name="gender_id"]').on('change', function () {
        $(this).valid();
    });
    $('select[name="blood_group_id"]').on('change', function () {
        $(this).valid();
    });

    // Hide error message for the unchecked option when one checkbox is checked
    $("input[name='isAuto'], input[name='isManual']").change(function () {
        if ($("input[name='isAuto']").is(":checked")) {
            $("input[name='isManual']").valid();
        } else if ($("input[name='isManual']").is(":checked")) {
            $("input[name='isAuto']").valid();
        }
    });

    // Form validation
    $("#vehicle_details").validate({
        rules: {
            vehicle_name: {
                required: true,
            },
            vehicle_no: {
                required: true,
            },
            ancap_rating: {
                required: true,
                number: true,
                min: 1,
                max: 5
            },
            vehicle_image: {
                required: function (element) {
                    // Check if the user already has a profile picture or not
                    return $('input[name="existing_vehicle_image"]').val() === "";
                },
                fileExtension: "jpeg|jpg|png",
                fileSize: true
            }
        },
        messages: {

            vehicle_image: {
                required: "Please upload a profile picture.",
                fileExtension: "Only JPG, JPEG, and PNG files are allowed.",
                filesize: "The file size must be less than 2MB."
            }
        },
        submitHandler: function (form, event) {
            //event.preventDefault();
            console.log("Form validated successfully");
            form.submit();

        }
    });

    // Function to update the disabled state of options
    $('#location_ids').select2();
    function updateOptionStates() {
        var selectedOptions = $('#location_ids').val();
        $('#location_ids').find('option').each(function () {
            var optionValue = $(this).val();

            if (selectedOptions && selectedOptions.includes(optionValue)) {

                $(this).prop('disabled', true);
            } else {

                $(this).prop('disabled', false);
            }
        });

        $('#location_ids').select2('close').select2('open');
    }

    $("#suburbs_details").validate({
        rules: {
            'location_id[]': {
                required: true
            },

        },
        messages: {
            'location_id[]': {
                required: "Please select at least one suburb."
            }
        },
        submitHandler: function (form) {
            $('#location_ids').find('option').prop('disabled', false);
            $('#location_ids').select2('close');
            console.log("Form validated successfully");
            form.submit();
        }
    });

    // Listen to the change event for option selection
    $('#location_ids').on('change', function () {

        updateOptionStates();
    });

    // Trigger the function to set the initial disabled state on page load
    updateOptionStates();

    $("#bank_details").validate({
        rules: {
            salaryPayModeId: {
                required: true,
                remote: {
                    url: "/admin/validate-salary-pay-mode",
                    type: "POST",
                    data: {
                        salaryPayModeId: function () {
                            return $("select[name='salaryPayModeId']").val();
                        },
                        _token: $("input[name='_token']").val()
                    },
                    dataFilter: function (response) {

                        var jsonResponse = JSON.parse(response);

                        if (jsonResponse.errors && jsonResponse.errors.salaryPayModeId) {
                            return "\"" + jsonResponse.errors.salaryPayModeId[0] + "\"";
                        }

                        return true;
                    }
                }
            },
            salaryBankName: {
                required: true
            },
            salaryBranchName: {
                required: true
            },
            salaryIFSCCode: {
                required: true
            },
            salaryAccountNumber: {
                required: true,
                digits: true,
                maxlength: 20
            }
        },
        messages: {
            salaryPayModeId: {
                required: "Please select a salary pay mode.",
                remote: "The selected salary pay mode is invalid."
            },
            salaryBankName: {
                required: "Please enter the bank name."
            },
            salaryBranchName: {
                required: "Please enter the branch name."
            },
            salaryIFSCCode: {
                required: "Please enter the IFSC code."
            },
            salaryAccountNumber: {
                required: "Please enter the account number.",
                digits: "Please enter only numbers.",
                maxlength: "Account number must be at most 20 digits long."
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    // Function to disable already selected options
    $('#price_id').select2();

    function disablePriceSelectedOptions() {
        var selectedOptions = $('#price_id').val();
        $('#price_id').find('option').each(function () {
            var optionValue = $(this).val();

            if (selectedOptions && selectedOptions.includes(optionValue)) {

                $(this).prop('disabled', true);
            } else {

                $(this).prop('disabled', false);
            }
        });

        $('#price_id').select2('close').select2('open');
    }

    $("#price_details").validate({
        rules: {
            'price_id[]': {
                required: true
            },

        },
        messages: {
            'price_id[]': {
                required: "Please select at least one price."
            }
        },
        submitHandler: function (form) {


            $('#price_id').find('option').prop('disabled', false);
            $('#price_id').select2('close');
            console.log("Form validated successfully");
            form.submit();
        }
    });

    // Listen to the change event for option selection
    $('#price_id').on('change', function () {

        disablePriceSelectedOptions();
    });

    // Trigger the function to set the initial disabled state on page load
    disablePriceSelectedOptions();

    /* Providing Lessons validation */
    $("#lessons").validate({

        rules: {
            title: {
                required: true,
                noWhitespace: true
            },
            description: {

                required: true,
            },
            status: {
                required: true,
            },
            'location_id[]': {
                required: true,
            },
            'pricing_id[]': {
                required: true,
            }
        },
        messages: {
            title: {
                required: "Please enter your title"
            },
            description: {
                required: "Please enter your description"
            },
            status: {
                required: "Please select status."
            }
        },
        submitHandler: function (form, event) {
            console.log("Form validated successfully");
            form.submit();

        }
    });
    $('select[name="location_id[]"]').on('change', function () {
        $(this).valid();
    });
    $('select[name="pricing_id[]"]').on('change', function () {
        $(this).valid();
    });
    // Custom method for description validation
    $.validator.addMethod("descriptionRequired", function (value, element) {


    }, "Description is required.");



    /* aboutus module */
    $('#aboutus').on('submit', function (e) {
        let isValid = true;
        $('.error-message').remove();
        $('.form-control').removeClass('is-invalid');

        if ($('input[name="title"]').val().trim() === '') {
            isValid = false;
            $('input[name="title"]').addClass('is-invalid').after('<div class="error-message text-danger">Title is required.</div>');
        }

        // Validate Description
        var description = $('textarea[name="description"]').summernote('code').trim();
        var tempDiv = document.createElement("div");
        tempDiv.innerHTML = description;

        description = (tempDiv.textContent.trim() === "") ? "" : description = tempDiv.innerHTML.trim();

        if (description == '') {
            isValid = false;
            $('textarea[name="description"]').addClass('is-invalid').after('<div class="error-message text-danger">Description is required.</div>');
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});