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
                required: true
            },
            isManual: {
                required: true
            },
            'languages[]': {
                checkboxRequired: 'input[name="languages[]"]'
            },
            date_of_joining: {
                required: true,
                //dateISO: true
            },
            date_of_termination: {
                required: true,
                //dateISO: true
            },
            gender_id: {
                required: true
            },
            phoneNo: {
                required: true,
                phoneAU: true
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
                required: true,
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
            profile_picture: {
                required: "Please upload a profile picture.",
                fileExtension: "Only JPG, JPEG, and PNG files are allowed.",
                fileSize: "File size must be less than 2048 KB."
            }
        },
        submitHandler: function (form, event) {
            //event.preventDefault();
            console.log("Form validated successfully");
            setTimeout(() => {
                form.submit();
            }, 1000);
        }
    });

    // Re-validate selects when their value changes
    $('select[name="gender_id"]').on('change', function () {
        $(this).valid();
    });
    $('select[name="blood_group_id"]').on('change', function () {
        $(this).valid();
    });



});