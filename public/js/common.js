$(document).ready(function () {

    /* Initialize editor */
    $('.summernote').summernote({
        height: 200,
        focus: true
    });

    /* lesson module */
    $('#lessonForm').on('submit', function (e) {
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
});